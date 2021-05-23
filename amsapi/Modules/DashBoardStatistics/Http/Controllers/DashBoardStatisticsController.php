<?php

namespace Modules\DashBoardStatistics\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

//Models
use DB;
use App\User;
use App\Contact;
use App\Role;
use App\RoleUser;

class DashBoardStatisticsController extends Controller
{
    public function index()
    {
        $data = User::select(array(
                    DB::raw("SUM(CASE WHEN role_users.role_id = 3 THEN 1 ELSE 0 END) AS 'agency'"),
                    DB::raw("SUM(CASE WHEN role_users.role_id = 6 THEN 1 ELSE 0 END) AS 'applicant'"),
                    DB::raw("SUM(CASE WHEN role_users.role_id = 4 THEN 1 ELSE 0 END) AS 'training'"),
                    DB::raw("SUM(CASE WHEN contacts.migration_status IS NOT NULL THEN 1 ELSE 0 END) AS 'migrant'"),
                    DB::raw("SUM(CASE WHEN role_users.role_id = 5 THEN 1 ELSE 0 END) AS 'financial'"),
                ))
                ->join('contacts', 'contacts.user_id', 'users.id')
                ->join('role_users', 'users.id', 'role_users.user_id')
                ->first();

        return response()->json($data);
    }

    public function allDataStatistics(Request $request)
    {
        $start      = isset($request['start'])?date('Y-m-d 00:00:00', strtotime($request['start'])):null;
        $end        = isset($request['end'])?date('Y-m-d 23:59:59', strtotime($request['end'])):null;
        $division_id      = isset($request['division_id'])?$request['division_id']:null;
        $district_id        = isset($request['district_id'])?$request['district_id']:null;

        $total_data = User::select(array(
                    DB::raw("SUM(CASE WHEN contacts.migration_status IS NULL THEN 1 ELSE 0 END) AS 'interested'"),
                    DB::raw("SUM(CASE WHEN contacts.migration_status IS NOT NULL THEN 1 ELSE 0 END) AS 'migrant'"),
                    DB::raw("SUM(CASE WHEN contacts.skill_status = 1 THEN 1 ELSE 0 END) AS 'skilled'"),
                    DB::raw("SUM(CASE WHEN contacts.skill_status = 0 THEN 1 ELSE 0 END) AS 'unskilled'"),
                ))
                ->join('contacts', 'contacts.user_id', 'users.id')
                ->join('role_users', 'users.id', 'role_users.user_id')
                ->where('role_users.role_id', 6)
                ->when($start, function($q) use($start,$end){return $q->whereBetween('users.created_at' , [$start, $end]);})
                ->first();

        $interested     = $total_data['interested']?(integer) $total_data['interested']:0;
        $skilled        = $total_data['skilled']?(integer) $total_data['skilled']:0;
        $unskilled      = $total_data['unskilled']?(integer) $total_data['unskilled']:0;
        $migrant        = $total_data['migrant']?(integer) $total_data['migrant']:0;

        $total_data['interested']   = $interested;
        $total_data['skilled']      = $skilled;
        $total_data['unskilled']    = $unskilled;
        $total_data['migrant']      = $migrant;

        $total_column_chart = [['Applicant', 'Interest Applicant', 'Skilled', 'Unskilled', 'Migrants']];
        $prepare_column_chart = ['Applicant', $interested, $skilled, $unskilled, $migrant];

        array_push($total_column_chart,$prepare_column_chart);

        $total_pie_chart = [['Applicant', 'Participants']];
        if($skilled>0 || $unskilled>0){
            array_push($total_pie_chart,['Skilled',$skilled]);
            array_push($total_pie_chart,['Unskilled',$unskilled]);
        }
        

        if($district_id && $division_id){
            $division_data = DB::table('geo_upazilas')->select('upazila_name_eng as name')->where('geo_district_id', $district_id)->get()->toArray();

            $total_data_list_interested = User::select(array(
                        DB::raw("geo_upazilas.upazila_name_eng AS name"),
                        DB::raw("count(contacts.subdistrict_id) AS total")
                    ))
                    ->join('contacts', function($join){
                        $join->on('contacts.user_id', 'users.id');
                        $join->whereNull('contacts.migration_status');
                    })
                    ->join('role_users', function($join){
                        $join->on('users.id','role_users.user_id');
                        $join->where('role_users.role_id', 6);
                    })
                    ->rightJoin('geo_upazilas', 'contacts.subdistrict_id', 'geo_upazilas.id')
                    ->where('geo_upazilas.geo_district_id', $district_id)
                    ->groupBy('geo_upazilas.id')
                    ->orderBy('geo_upazilas.id')
                    ->when($start, function($q) use($start,$end){return $q->whereBetween('users.created_at' , [$start, $end]);})
                    ->get();

            $total_data_list_migrant = User::select(array(
                        DB::raw("geo_upazilas.upazila_name_eng AS name"),
                        DB::raw("count(contacts.subdistrict_id) AS total")
                    ))
                    ->join('contacts', function($join){
                        $join->on('contacts.user_id', 'users.id');
                        $join->whereNotNull('contacts.migration_status');
                    })
                    ->join('role_users', function($join){
                        $join->on('users.id','role_users.user_id');
                        $join->where('role_users.role_id', 6);
                    })
                    ->rightJoin('geo_upazilas', 'contacts.subdistrict_id', 'geo_upazilas.id')
                    ->where('geo_upazilas.geo_district_id', $district_id)
                    ->groupBy('geo_upazilas.id')
                    ->orderBy('geo_upazilas.id')
                    ->when($start, function($q) use($start,$end){return $q->whereBetween('users.created_at' , [$start, $end]);})
                    ->get();

            $total_data_list_skilled = User::select(array(
                        DB::raw("geo_upazilas.upazila_name_eng AS name"),
                        DB::raw("count(contacts.subdistrict_id) AS total")
                    ))
                    ->join('contacts', function($join){
                        $join->on('contacts.user_id', 'users.id');
                        $join->where('contacts.skill_status', 1);
                    })
                    ->join('role_users', function($join){
                        $join->on('users.id','role_users.user_id');
                        $join->where('role_users.role_id', 6);
                    })
                    ->rightJoin('geo_upazilas', 'contacts.subdistrict_id', 'geo_upazilas.id')
                    ->where('geo_upazilas.geo_district_id', $district_id)
                    ->groupBy('geo_upazilas.id')
                    ->orderBy('geo_upazilas.id')
                    ->when($start, function($q) use($start,$end){return $q->whereBetween('users.created_at' , [$start, $end]);})
                    ->get();

            $total_data_list_unskilled = User::select(array(
                        DB::raw("geo_upazilas.upazila_name_eng AS name"),
                        DB::raw("count(contacts.subdistrict_id) AS total")
                    ))
                    ->join('contacts', function($join){
                        $join->on('contacts.user_id', 'users.id');
                        $join->where('contacts.skill_status', 0);
                    })
                    ->join('role_users', function($join){
                        $join->on('users.id','role_users.user_id');
                        $join->where('role_users.role_id', 6);
                    })
                    ->rightJoin('geo_upazilas', 'contacts.subdistrict_id', 'geo_upazilas.id')
                    ->where('geo_upazilas.geo_district_id', $district_id)
                    ->groupBy('geo_upazilas.id')
                    ->orderBy('geo_upazilas.id')
                    ->when($start, function($q) use($start,$end){return $q->whereBetween('users.created_at' , [$start, $end]);})
                    ->get();
                    
        }
        else if($division_id){
            
            $division_data = DB::table('geo_districts')->select('district_name_eng as name')->where('geo_division_id', $division_id)->get()->toArray();

            $total_data_list_interested = User::select(array(
                        DB::raw("geo_districts.district_name_eng AS name"),
                        DB::raw("count(contacts.district_id) AS total")
                    ))
                    ->join('contacts', function($join){
                        $join->on('contacts.user_id', 'users.id');
                        $join->whereNull('contacts.migration_status');
                    })
                    ->join('role_users', function($join){
                        $join->on('users.id','role_users.user_id');
                        $join->where('role_users.role_id', 6);
                    })
                    ->rightJoin('geo_districts', 'contacts.district_id', 'geo_districts.id')
                    ->where('geo_districts.geo_division_id', $division_id)
                    ->groupBy('geo_districts.id')
                    ->orderBy('geo_districts.id')
                    ->when($start, function($q) use($start,$end){return $q->whereBetween('users.created_at' , [$start, $end]);})
                    ->get();
            
            $total_data_list_migrant = User::select(array(
                        DB::raw("geo_districts.district_name_eng AS name"),
                        DB::raw("count(contacts.district_id) AS total")
                    ))
                    ->join('contacts', function($join){
                        $join->on('contacts.user_id', 'users.id');
                        $join->whereNotNull('contacts.migration_status');
                    })
                    ->join('role_users', function($join){
                        $join->on('users.id','role_users.user_id');
                        $join->where('role_users.role_id', 6);
                    })
                    ->rightJoin('geo_districts', 'contacts.district_id', 'geo_districts.id')
                    ->where('geo_districts.geo_division_id', $division_id)
                    ->groupBy('geo_districts.id')
                    ->orderBy('geo_districts.id')
                    ->when($start, function($q) use($start,$end){return $q->whereBetween('users.created_at' , [$start, $end]);})
                    ->get();

            $total_data_list_skilled = User::select(array(
                        DB::raw("geo_districts.district_name_eng AS name"),
                        DB::raw("count(contacts.district_id) AS total")
                    ))
                    ->join('contacts', function($join){
                        $join->on('contacts.user_id', 'users.id');
                        $join->where('contacts.skill_status', 1);
                    })
                    ->join('role_users', function($join){
                        $join->on('users.id','role_users.user_id');
                        $join->where('role_users.role_id', 6);
                    })
                    ->rightJoin('geo_districts', 'contacts.district_id', 'geo_districts.id')
                    ->where('geo_districts.geo_division_id', $division_id)
                    ->groupBy('geo_districts.id')
                    ->orderBy('geo_districts.id')
                    ->when($start, function($q) use($start,$end){return $q->whereBetween('users.created_at' , [$start, $end]);})
                    ->get();

            $total_data_list_unskilled = User::select(array(
                        DB::raw("geo_districts.district_name_eng AS name"),
                        DB::raw("count(contacts.district_id) AS total")
                    ))
                    ->join('contacts', function($join){
                        $join->on('contacts.user_id', 'users.id');
                        $join->where('contacts.skill_status', 0);
                    })
                    ->join('role_users', function($join){
                        $join->on('users.id','role_users.user_id');
                        $join->where('role_users.role_id', 6);
                    })
                    ->rightJoin('geo_districts', 'contacts.district_id', 'geo_districts.id')
                    ->where('geo_districts.geo_division_id', $division_id)
                    ->groupBy('geo_districts.id')
                    ->orderBy('geo_districts.id')
                    ->when($start, function($q) use($start,$end){return $q->whereBetween('users.created_at' , [$start, $end]);})
                    ->get();
        }
        else{
            // return 1;
            $division_data = DB::table('geo_divisions')->select('division_name_eng as name')->get()->toArray();

            $total_data_list_interested = User::select(array(
                        DB::raw("geo_divisions.division_name_eng AS name"),
                        DB::raw("count(contacts.division_id) AS total")
                    ))
                    ->join('contacts', function($join){
                        $join->on('contacts.user_id', 'users.id');
                        $join->whereNull('contacts.migration_status');
                    })
                    ->join('role_users', function($join){
                        $join->on('users.id','role_users.user_id');
                        $join->where('role_users.role_id', 6);
                    })
                    ->rightJoin('geo_divisions', 'contacts.division_id', 'geo_divisions.id')
                    ->groupBy('geo_divisions.id')
                    ->orderBy('geo_divisions.id')
                    ->when($start, function($q) use($start,$end){return $q->whereBetween('users.created_at' , [$start, $end]);})
                    ->get();

            $total_data_list_migrant = User::select(array(
                        DB::raw("geo_divisions.division_name_eng AS name"),
                        DB::raw("count(contacts.division_id) AS total")
                    ))
                    ->join('contacts', function($join){
                        $join->on('contacts.user_id', 'users.id');
                        $join->whereNotNull('contacts.migration_status');
                    })
                    ->join('role_users', function($join){
                        $join->on('users.id','role_users.user_id');
                        $join->where('role_users.role_id', 6);
                    })
                    ->rightJoin('geo_divisions', 'contacts.division_id', 'geo_divisions.id')
                    ->groupBy('geo_divisions.id')
                    ->orderBy('geo_divisions.id')
                    ->when($start, function($q) use($start,$end){return $q->whereBetween('users.created_at' , [$start, $end]);})
                    ->get();

            $total_data_list_skilled = User::select(array(
                        DB::raw("geo_divisions.division_name_eng AS name"),
                        DB::raw("count(contacts.division_id) AS total")
                    ))
                    ->join('contacts', function($join){
                        $join->on('contacts.user_id', 'users.id');
                        $join->where('contacts.skill_status', 1);
                    })
                    ->join('role_users', function($join){
                        $join->on('users.id','role_users.user_id');
                        $join->where('role_users.role_id', 6);
                    })
                    ->rightJoin('geo_divisions', 'contacts.division_id', 'geo_divisions.id')
                    ->groupBy('geo_divisions.id')
                    ->orderBy('geo_divisions.id')
                    ->when($start, function($q) use($start,$end){return $q->whereBetween('users.created_at' , [$start, $end]);})
                    ->get();

            $total_data_list_unskilled = User::select(array(
                        DB::raw("geo_divisions.division_name_eng AS name"),
                        DB::raw("count(contacts.division_id) AS total")
                    ))
                    ->join('contacts', function($join){
                        $join->on('contacts.user_id', 'users.id');
                        $join->where('contacts.skill_status', 0);
                    })
                    ->join('role_users', function($join){
                        $join->on('users.id','role_users.user_id');
                        $join->where('role_users.role_id', 6);
                    })
                    ->rightJoin('geo_divisions', 'contacts.division_id', 'geo_divisions.id')
                    ->groupBy('geo_divisions.id')
                    ->orderBy('geo_divisions.id')
                    ->when($start, function($q) use($start,$end){return $q->whereBetween('users.created_at' , [$start, $end]);})
                    ->get();
        }
        
        $total_data_list = [];
        
        for($i=0;$i<count($division_data);$i++){
            $total_data_list[$i]['name'] = $division_data[$i]->name;
            $total_data_list[$i]['interested'] = isset($total_data_list_interested[$i]['total'])?$total_data_list_interested[$i]['total']:0;
            $total_data_list[$i]['migrant'] = isset($total_data_list_migrant[$i]['total'])?$total_data_list_migrant[$i]['total']:0;
            $total_data_list[$i]['skilled'] = isset($total_data_list_skilled[$i]['total'])?$total_data_list_skilled[$i]['total']:0;
            $total_data_list[$i]['unskilled'] = isset($total_data_list_unskilled[$i]['total'])?$total_data_list_unskilled[$i]['total']:0;

        }

        $data = [];
        $data['total_data']         = $total_data;
        $data['total_column_chart'] = $total_column_chart;
        $data['total_pie_chart']    = $total_pie_chart;
        $data['total_data_list']    = $total_data_list;

        return response()->json($data);
    }
}
