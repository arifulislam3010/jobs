export default function({ store, redirect,error }) {
    if (store.state.auth.loggedIn){
        if( store.state.auth.user.role_id == 3){
            return true;
        }
        else{
            return redirect('/dashboard')
        }
    }else{
        error({
            message: 'You are not connected',
            statusCode: 403
          })
    }
  }