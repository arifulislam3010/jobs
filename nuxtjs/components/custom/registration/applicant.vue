<template>
  <form-wizard  color="#74CE35" @on-complete="onComplete" back-button-text="আগে"  next-button-text="পরবর্তী"  finish-button-text="নিবন্ধন">
    <h2 slot="title"></h2>
    <tab-content title="ব্যক্তিগত তথ্য" :before-change="beforeAddress" icon="fa fa-user-o" >
      <div class="row">
        <div class="col-md-5">
          <div class="form-group row">
            <label for="inputPassword" class="col-md-4 labels">
              ইমেইল/ফোন
              <span class="required">*</span>
            </label>
            <input
              name="Email" @keyup="errorRemove"
              class="form-control col-md-8"
              v-validate="'required'"
              type="text"
              v-model="email"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Email')"
                class="validation_message"
              >{{ errors.first('Email') }}</span>
              <span
                v-if="error_message"
                class="validation_message"
              >{{ error_message }}</span>
            </div>
          </div>
          <div class="form-group row">
            <label style="margin-top:15px;" for="inputPassword" class="col-md-4 labels">
              পাসওয়ার্ড
              <span class="required">*</span>
            </label>
            <input
              style="margin-top:15px;"
              name="Password"
              class="col-md-8 form-control"
              type="password"
              v-validate="'required'"
              v-model="password"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Password')"
                class="validation_message"
              >{{ errors.first('Password') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-4">
          <div v-if="url" class="image_upload logo_upload">
            <span class="removeImage" @click="RemoveImage">X</span>
            <img :src="url" class="fitimage" />
          </div>
          <div v-else class="image_upload logo_upload" @click="$refs.ImageFile.click()">
            <p>ছবি বাছাই করুন</p>
            <i class="fas fa-cloud-upload-alt"></i>
            <input
              type="file"
              ref="ImageFile"
              class="file-input"
              style="display: none"
              v-on:change="imageChanged"
            />
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
          <div class="form-group row">
            <label for="inputPassword" class="col-md-4 labels">
              পূর্ণনাম
              <span class="required">*</span>
            </label>
            <a-date-picker  />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Full name')"
                class="validation_message"
              >{{ errors.first('Full name') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
          <div class="form-group row">
            <label style="margin-top:15px;" for="inputPassword" class="col-md-4 labels">
              পিতার নাম
              <span class="required">*</span>
            </label>
            <input
              style="margin-top:15px;"
              name="Father name"
              class="col-md-8 form-control"
              type="text"
              v-validate="'required'"
              v-model="personal.father_name"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Father name')"
                class="validation_message"
              >{{ errors.first('Father name') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group row">
            <label for="inputPassword" class="col-md-4 labels">
              মাতার নাম
              <span class="required">*</span>
            </label>
            <input
              name="Mother name"
              class="col-md-8 form-control"
              type="text"
              v-model="personal.mother_name"
              v-validate="'required'"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Mother name')"
                class="validation_message"
              >{{ errors.first('Mother name') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
          <div class="form-group row">
            <label for="inputPassword" class="col-md-4 labels">স্বামী/স্ত্রীর নাম</label>
            <input
              name="Spouse name"
              class="col-md-8 form-control"
              type="text"
              v-model="personal.spouse_name"
            />
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">জাতীয় পরিচয়পত্র নম্বর</label>
            <input
              name="National ID"
              class="form-control col-md-8"
              type="text"
              v-model="personal.nid"
            />
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
          <div class="form-group row">
            <label class="labels col-md-3" for="#firstName">
              জন্মস্থান
              <span class="required">*</span>
            </label>
            <div class="col-md-9">
              <div style="padding-left:6px;">
                <multiselect
                  name="country"
                  style="margin-left:15px;"
                  v-validate="'required'"
                  v-model="personal.country"
                  placeholder="দেশ নির্বাচন করুন"
                  label="country_name"
                  track-by="id"
                  :options="countries"
                ></multiselect>
              </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('country')"
                class="validation_message"
              >{{ errors.first('country') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group row">
            <label class="labels col-md-3" for="#firstName">
              জেলা
              <span class="required">*</span>
            </label>
            <div class="col-md-9">
              <div style="padding-left:6px;">
                <multiselect
                  style="margin-left:15px;"
                  name="district"
                  v-validate="'required'"
                  v-model="personal.district"
                  placeholder="জেলা নির্বাচন করুন"
                  label="district_name_eng"
                  track-by="id"
                  :options="districts"
                ></multiselect>
              </div>
              <div class="col-md-3"></div>
              <div class="col-md-9">
                <span
                  v-if="errors.has('district')"
                  class="validation_message"
                >{{ errors.first('district') }}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
          <div class="form-group row">
            <label class="labels col-md-3" for="#firstName">
             জন্ম তারিখ
              <span class="required">*</span>
            </label>
            <div class="col-md-9">
              <div style="padding:3px;">
                <VueCtkDateTimePicker
                  name="birth_date"
                  style="margin-left:18px;"
                  v-validate="'required'"
                  v-model="personal.birth_date"
                  label="তারিখ নির্বাচন করুন"
                  :only-date="true"
                />
              </div>
              <div class="col-md-3"></div>
              <div class="col-md-9">
                <span
                  v-if="errors.has('birth_date')"
                  class="validation_message"
                >{{ errors.first('birth_date') }}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">
              জাতীয়তা
              <span class="required">*</span>
            </label>
            <input
              name="Nationality"
              v-validate="'required'"
              class="form-control col-md-8"
              type="text"
              v-model="personal.nationality"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Nationality')"
                class="validation_message"
              >{{ errors.first('Nationality') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">
              বৈবাহিক অবস্থা
              <span class="required">*</span>
            </label>
            <select
              class="form-control col-md-8"
              id="exampleFormControlSelect1"
              name="Marital Status"
              v-validate="'required'"
              v-model="personal.marital_status"
            >
              <option value>বৈবাহিক অবস্থা নির্বাচন করুন</option>
              <option value="Married">Married</option>
              <option value="Unmarried">Unmarried</option>
            </select>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Marital Status')"
                class="validation_message"
              >{{ errors.first('Marital Status') }}</span>
            </div>
          </div>
        </div>

        <div class="col-md-5">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">
              লিঙ্গ
              <span class="required">*</span>
            </label>
            <select
              name="Sex"
              class="form-control col-md-8"
              id="exampleFormControlSelect1"
              v-model="personal.sex"
              v-validate="'required'"
            >
              <option value>লিঙ্গ নির্বাচন করুন</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Others">Others</option>
            </select>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span v-if="errors.has('Sex')" class="validation_message">{{ errors.first('Sex') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">
              ধর্ম
              <span class="required">*</span>
            </label>
            <select
              class="form-control col-md-8"
              id="exampleFormControlSelect1"
              v-model="personal.religion"
              v-validate="'required'"
              name="Religion"
            >
              <option value>ধর্ম নির্বাচন করুন</option>
              <option value="Islam">ইসলাম</option>
              <option value="Hinduism">হিন্দুধর্ম</option>
              <option value="Christianity">খ্রীষ্টধর্ম</option>
              <option value="Buddhism">বৌদ্ধধর্ম</option>
              <option value="Others">অন্যান্য</option>
            </select>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Religion')"
                class="validation_message"
              >{{ errors.first('Religion') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group row">
            <label class="labels col-md-3" for="#firstName">
              কাঙ্খিত চাকুরী
              <span class="required">*</span>
            </label>
            <div class="col-md-9">
              <div style="padding-left:6px;">
                <multiselect
                  style="margin-left:15px;"
                  v-validate="'required'"
                  data-vv-name="Desired Job"
                  data-vv-value-path="name"
                  v-model="personal.job"
                  tag-placeholder="Add this as new job"
                  placeholder="কাঙ্ক্ষিত চাকুরী নির্বাচন করুন"
                  label="name"
                  track-by="id"
                  :options="desired_jobs"
                  :multiple="true"
                  :taggable="true"
                ></multiselect>
              </div>
              <div class="col-md-3"></div>
              <div class="col-md-9">
                <span
                  v-if="errors.has('Desired Job')"
                  class="validation_message"
                >{{ errors.first('Desired Job') }}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">
              ওজন (কেজি)
              <span class="required">*</span>
            </label>
            <input
              name="Weight"
              v-validate="'required'"
              class="form-control col-md-8"
              type="text"
              v-model="personal.weight"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Weight')"
                class="validation_message"
              >{{ errors.first('Weight') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">
              উচ্চতা (মিটার)
              <span class="required">*</span>
            </label>
            <input
              class="form-control col-md-8"
              type="text"
              name="Height"
              v-model="personal.height"
              v-validate="'required'"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Height')"
                class="validation_message"
              >{{ errors.first('Height') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">কন্যার সংখ্যা</label>
            <input
              id="firstName"
              class="form-control col-md-8"
              type="text"
              v-model="personal.no_daughter"
            />
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">পুত্রের সংখ্যা</label>
            <input
              id="firstName"
              class="form-control col-md-8"
              type="text"
              v-model="personal.no_son"
            />
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
          <div class="form-group row">
            <label class="labels col-md-3" for="#firstName">পাসপোর্ট ইস্যু তারিখ</label>
            <div class="col-md-9">
              <div style="padding:3px;">
                <VueCtkDateTimePicker
                  style="margin-left:18px;"
                  v-model="personal.passport_date"
                  label="তারিখ নির্বাচন করুন"
                  :only-date="true"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">পাসপোর্ট নম্বর</label>
            <input
              id="firstName"
              class="form-control col-md-8"
              type="text"
              value="Height"
              v-model="personal.passport_no"
            />
          </div>
        </div>
      </div>
    </tab-content>
    <tab-content title="ঠিকানা" :before-change="beforeNominee" icon="fas fa-address-card">
      <div v-if="address_tab" class="row">
        <div style="background-color:#d6d6c2;margin-bottom:15px;" class="col-md-11">
          <div>
            <p style="padding-top:12px;">স্থায়ী ঠিকানা</p>
          </div>
        </div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-3" for="#firstName">
              বিভাগ
              <span class="required">*</span>
            </label>
            <div class="col-md-9">
              <div style="padding-left:6px;">
                <multiselect
                  name="Permanent Division"
                  v-validate="'required'"
                  style="margin-left:15px;"
                  @input="getDistrictByID2()"
                  v-model="address2.division"
                  placeholder="বিভাগ নির্বাচন করুন"
                  label="division_name_eng"
                  track-by="id"
                  :options="divisions"
                ></multiselect>
              </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Permanent Division')"
                class="validation_message"
              >{{ errors.first('Permanent Division') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-3" for="#firstName">
              জেলা
              <span class="required">*</span>
            </label>
            <div class="col-md-9">
              <div style="padding-left:6px;">
                <multiselect
                  name="Permanent District"
                  v-validate="'required'"
                  style="margin-left:15px;"
                  v-model="address2.district"
                  @input="getSubdistrict2()"
                  placeholder="জেলা নির্বাচন করুন"
                  label="district_name_eng"
                  track-by="id"
                  :options="total2.districts2"
                ></multiselect>
              </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Permanent District')"
                class="validation_message"
              >{{ errors.first('Permanent District') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-3" for="#firstName">
              থানা/উপজেলা
              <span class="required">*</span>
            </label>
            <div class="col-md-9">
              <div style="padding-left:6px;">
                <multiselect
                  style="margin-left:15px;"
                  name="Permanent Thana/ Upazilla"
                  v-validate="'required'"
                  v-model="address2.subdistrict"
                  @input="getUnion2()"
                  placeholder="থানা/উপজেলা নির্বাচন করুন"
                  label="upazila_name_eng"
                  track-by="id"
                  :options="total2.subdistricts2"
                ></multiselect>
              </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Permanent Thana/ Upazilla')"
                class="validation_message"
              >{{ errors.first('Permanent Thana/ Upazilla') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-3" for="#firstName">
              ওয়ার্ড/ ইউনিয়ন
              <span class="required">*</span>
            </label>
            <div class="col-md-9">
              <div style="padding-left:6px;">
                <multiselect
                  style="margin-left:15px;"
                  name="Permanent Ward/ Union"
                  v-validate="'required'"
                  v-model="address2.union"
                  placeholder="ওয়ার্ড/ ইউনিয়ন নির্বাচন করুন"
                  label="union_name_eng"
                  track-by="id"
                  :options="total2.unions2"
                ></multiselect>
              </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Permanent Ward/ Union')"
                class="validation_message"
              >{{ errors.first('Permanent Ward/ Union') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">
              Area/ Village
              <span class="required">*</span>
            </label>
            <input
              id="firstName"
              name="Permanent Area/ Village"
              v-validate="'required'"
              class="form-control col-md-8"
              type="text"
              v-model="address2.village"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Permanent Area/ Village')"
                class="validation_message"
              >{{ errors.first('Permanent Area/ Village') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">
              পোস্ট অফিস
              <span class="required">*</span>
            </label>
            <input
              name="Permanent Post Office"
              v-validate="'required'"
              id="firstName"
              class="form-control col-md-8"
              type="text"
              v-model="address2.postoffice"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Permanent Post Office')"
                class="validation_message"
              >{{ errors.first('Permanent Post Office') }}</span>
            </div>
          </div>
        </div>

        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">রোডনম্বর/ পাড়া</label>
            <input
              id="firstName"
              class="form-control col-md-8"
              type="text"
              v-model="address2.street"
            />
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">ফোন</label>
            <input
              id="firstName"
              name="National ID"
              class="form-control col-md-8"
              type="text"
              v-model="address2.phone"
            />
          </div>
        </div>
        <div style="background-color:#d6d6c2;margin-bottom:15px;" class="col-md-11">
          <div class="row">
            <div class="col-md-6">
              <p style="padding-top:12px;">চিঠি পাঠানোর ঠিকানা</p>
            </div>
            <div class="col-md-6">
              <p style="margin-top:15px;float:right">
                <input
                  v-model="same_address"
                  name="checkbox"
                  @click="sameAddress();"
                  type="checkbox"
                  id="checkbox"
                />স্থায়ী ঠিকানার অনুরূপ
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-3" for="#firstName">
              বিভাগ
              <span class="required">*</span>
            </label>
            <div class="col-md-9">
              <div style="padding-left:6px;">
                <multiselect
                  style="margin-left:15px;"
                  v-validate="'required'"
                  name="Division"
                  @input="getDistrictByID3()"
                  v-model="address3.division"
                  placeholder="বিভাগ নির্বাচন করুন"
                  label="division_name_eng"
                  track-by="id"
                  :options="divisions"
                ></multiselect>
              </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Division')"
                class="validation_message"
              >{{ errors.first('Division') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-3" for="#firstName">
              জেলা
              <span class="required">*</span>
            </label>
            <div class="col-md-9">
              <div style="padding-left:6px;">
                <multiselect
                  style="margin-left:15px;"
                  v-validate="'required'"
                  name="District"
                  v-model="address3.district"
                  @input="getSubdistrict3()"
                  placeholder="জেলা নির্বাচন করুন"
                  label="district_name_eng"
                  track-by="id"
                  :options="total3.districts2"
                ></multiselect>
              </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('District')"
                class="validation_message"
              >{{ errors.first('District') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-3" for="#firstName">
              থানা/উপজেলা
              <span class="required">*</span>
            </label>
            <div class="col-md-9">
              <div style="padding-left:6px;">
                <multiselect
                  style="margin-left:15px;"
                  v-validate="'required'"
                  name="Thana/ Upazilla"
                  v-model="address3.subdistrict"
                  @input="getUnion3()"
                  placeholder="থানা/উপজেলা নির্বাচন করুন"
                  label="upazila_name_eng"
                  track-by="id"
                  :options="total3.subdistricts2"
                ></multiselect>
              </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Thana/ Upazilla')"
                class="validation_message"
              >{{ errors.first('Thana/ Upazilla') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-3" for="#firstName">
              ওয়ার্ড/ ইউনিয়ন
              <span class="required">*</span>
            </label>
            <div class="col-md-9">
              <div style="padding-left:6px;">
                <multiselect
                  style="margin-left:15px;"
                  v-validate="'required'"
                  name="Ward/ Union"
                  v-model="address3.union"
                  placeholder="ওয়ার্ড/ ইউনিয়ন নির্বাচন করুন"
                  label="union_name_eng"
                  track-by="id"
                  :options="total3.unions2"
                ></multiselect>
              </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Ward/ Union')"
                class="validation_message"
              >{{ errors.first('Ward/ Union') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">
              অঞ্চল / গ্রাম
              <span class="required">*</span>
            </label>
            <input
              id="firstName"
              v-validate="'required'"
              name="Area/ Village"
              class="form-control col-md-8"
              type="text"
              v-model="address3.village"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Area/ Village')"
                class="validation_message"
              >{{ errors.first('Area/ Village') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">
              পোস্ট অফিস
              <span class="required">*</span>
            </label>
            <input
              v-validate="'required'"
              name="Post Office"
              id="firstName"
              class="form-control col-md-8"
              type="text"
              v-model="address3.postoffice"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Post Office')"
                class="validation_message"
              >{{ errors.first('Post Office') }}</span>
            </div>
          </div>
        </div>

        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">রোডনম্বর/পাড়া</label>
            <input
              id="firstName"
              class="form-control col-md-8"
              type="text"
              v-model="address3.street"
            />
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">ফোন</label>
            <input
              id="firstName"
              name="National ID"
              class="form-control col-md-8"
              type="text"
              v-model="address3.phone"
            />
          </div>
        </div>
      </div>
    </tab-content>
     <tab-content title="নমিনী" :before-change="beforeEducation" icon="fas fa-user">
      <div v-if="nominee_tab" class="row">
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">
              নমিনীর নাম
              <span class="required">*</span>
            </label>
            <input
              id="firstName"
              v-validate="'required'"
              name="Nominee Name"
              class="form-control col-md-8"
              type="text"
              v-model="nominee.name"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Nominee Name')"
                class="validation_message"
              >{{ errors.first('Nominee Name') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">
              সম্পর্ক
              <span class="required">*</span>
            </label>
            <input
              id="firstName"
              v-validate="'required'"
              name="Relation"
              class="form-control col-md-8"
              type="text"
              v-model="nominee.relation"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Relation')"
                class="validation_message"
              >{{ errors.first('Relation') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">
              ফোন/মোবাইল
              <span class="required">*</span>
            </label>
            <input
              id="firstName"
              v-validate="'required'"
              name="Phone/Mobile"
              class="form-control col-md-8"
              type="text"
              v-model="nominee.phone"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Phone/Mobile')"
                class="validation_message"
              >{{ errors.first('Phone/Mobile') }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">
              ঠিকানা
              <span class="required">*</span>
            </label>
            <textarea
              v-validate="'required'"
              name="Address"
              class="form-control col-md-8"
              id="exampleFormControlTextarea1"
              v-model="nominee.address"
              rows="2"
            ></textarea>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has('Address')"
                class="validation_message"
              >{{ errors.first('Address') }}</span>
            </div>
          </div>
        </div>
      </div>
    </tab-content>
    <tab-content title="শিক্ষা" :before-change="beforeLanguage" icon="fas fa-graduation-cap" >
      <div v-if="education_tab" v-for="(education,key) in educations" :key="key" class="row">
        <div class="col-md-3 align-self-center">
          <div class="form-group row">
            <label for="inputPassword" class="col-md-4 labels">
              ডিগ্রীর নাম
              <span class="required">*</span>
            </label>
            <input
              id="firstName"
              v-validate="{required:true}"
              data-vv-as="Degree Name"
              :name="`${key}_degreeName`"
              class="col-md-8 form-control"
              type="text"
              v-model="education.degree"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has(`${key}_degreeName`)"
                class="validation_message"
              >{{ errors.first(`${key}_degreeName`) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-3 align-self-center">
          <div class="form-group row">
            <label for="inputPassword" class="col-md-4 labels">
              পাশের সন
              <span class="required">*</span>
            </label>
            <select
              v-model="education.p_year"
              v-validate="{required:true}"
              data-vv-as="Passing Year"
              :name="`${key}_p_year`"
              class="form-control col-md-8"
              id="exampleFormControlSelect1"
            >
              <option value>পাশেরসন</option>
              <option value="2011">2011</option>
              <option value="2012">2012</option>
              <option value="2013">2013</option>
              <option value="2014">2014</option>
            </select>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has(`${key}_p_year`)"
                class="validation_message"
              >{{ errors.first(`${key}_p_year`) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-3 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">
              শিক্ষা প্রতিষ্ঠান/ স্কুল
              <span class="required">*</span>
            </label>
            <input
              v-validate="{required:true}"
              data-vv-as="Institute/School"
              :name="`${key}_institute`"
              class="form-control col-md-8"
              type="text"
              v-model="education.institute"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has(`${key}_institute`)"
                class="validation_message"
              >{{ errors.first(`${key}_institute`) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1">
          <p @click="removeEducation(key)" style="cursor:pointer">
            বাদ দিন
            <i class="far fa-trash-alt"></i>
          </p>
        </div>
        <div class="col-md-3 align-self-center">
          <div class="form-group row">
            <label for="inputPassword" class="col-md-4 labels">
              শিক্ষা বোর্ড
              <span class="required">*</span>
            </label>
            <select
                v-validate="{required:true}"
              data-vv-as="Board"
              :name="`${key}_board`"
              class="form-control col-md-8"
              id="exampleFormControlSelect1"
              v-model="education.board"
            >
              <option value>শিক্ষা বোর্ড</option>
              <option value="Barisal">Barisal</option>
              <option value="Chittagong">Chittagong</option>
              <option value="Comilla">Comilla</option>
              <option value="Dhaka">Dhaka</option>
              <option value="Jessore">Jessore</option>
              <option value="Mymensingh">Mymensingh</option>
              <option value="Rajshahi">Rajshahi</option>
              <option value="Sylhet">Sylhet</option>
              <option value="Dinajpur">Dinajpur</option>
              <option value="Madrasah">Madrasah</option>
              <option value="Technical">Technical</option>
            </select>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has(`${key}_board`)"
                class="validation_message"
              >{{ errors.first(`${key}_board`) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-3 align-self-center">
          <div class="form-group row">
            <label for="inputPassword" class="col-md-4 labels">
              বিষয়
              <span class="required">*</span>
            </label>
            <input
              id="firstName"
              v-validate="{required:true}"
              data-vv-as="Subject"
              :name="`${key}_subject`"
              class="col-md-8 form-control"
              type="text"
              v-model="education.subject"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has(`${key}_subject`)"
                class="validation_message"
              >{{ errors.first(`${key}_subject`) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-3 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">
              গ্রেড/ ডিভিশান
              <span class="required">*</span>
            </label>
            <input
              id="firstName"
              v-validate="{required:true}"
              data-vv-as="Grade/ division"
              :name="`${key}_grade`"
              class="form-control col-md-8"
              type="text"
              v-model="education.grade"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has(`${key}_grade`)"
                class="validation_message"
              >{{ errors.first(`${key}_grade`) }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <button @click="addMoreEducation()" class="btn btn-secondary btn-sm">আরও যোগ করুন</button>
        </div>
      </div>
    </tab-content>
    <tab-content  title="ভাষা" :before-change="beforeExperience" icon="fa fa-language" >
      <div v-if="language_tab" class="row" v-for="(language,key) in languages" :key="key">
        <div class="col-md-3 align-self-center">
          <div class="form-group row">
            <label style="font-size:13px;" for="inputPassword" class="col-md-4 labels">ভাষা<span class="required">*</span></label>
            <div class="col-md-8">
              <multiselect
                v-validate="{required:true}"
              data-vv-as="Language"
              :name="`${key}_language`"
                v-model="language.language"
                placeholder="ভাষা"
                label="name"
                track-by="id"
                :options="language_list"
              ></multiselect>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has(`${key}_language`)"
                class="validation_message"
              >{{ errors.first(`${key}_language`) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-3 align-self-center">
          <div class="form-group row">
            <label for="inputPassword" class="col-md-4 labels">মৌখিক দক্ষতা<span class="required">*</span></label>
            <select
                v-validate="{required:true}"
              data-vv-as="Oral Skill"
              :name="`${key}_oral_skill`"
              v-model="language.oral_skill"
              class="form-control col-md-8"
              id="exampleFormControlSelect1"
            >
              <option value>মৌখিক দক্ষতা</option>
              <option value="Excellent">Excellent</option>
              <option value="Good">Good</option>
              <option value="Workable">Workable</option>
            </select>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has(`${key}_oral_skill`)"
                class="validation_message"
              >{{ errors.first(`${key}_oral_skill`) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-3 align-self-center">
          <div class="form-group row">
            <label for="inputPassword" class="col-md-4 labels">লিখন দক্ষতা<span class="required">*</span> </label> 
            <select
             v-validate="{required:true}"
              data-vv-as="Writing Skill"
              :name="`${key}_writing_skill`"
              v-model="language.writing_skill"
              class="form-control col-md-8"
              id="exampleFormControlSelect1"
            >
              <option value>লিখন দক্ষতা</option>
              <option value="Excellent">Excellent</option>
              <option value="Good">Good</option>
              <option value="Workable">Workable</option>
            </select>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has(`${key}_writing_skill`)"
                class="validation_message"
              >{{ errors.first(`${key}_writing_skill`) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1">
          <p @click="removeLanguage(key)" style="cursor:pointer">
            বাদ দিন
            <i class="far fa-trash-alt"></i>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <button @click="addMoreLanguage()" class="btn btn-secondary btn-sm">আরও যোগ করুন</button>
        </div>
      </div>
    </tab-content>
    <tab-content title="অভিজ্ঞতা" :before-change="beforeTraining" icon="fas fa-star">
      <div v-if="experience_tab" class="row" v-for="(experience,key) in experiences" :key="key">
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label for="inputPassword" class="col-md-4 labels">
              কোম্পানী নাম
              <span class="required">*</span>
            </label>
            <input
              id="firstName"
              v-validate="{required:true}"
              data-vv-as="Company Name"
              :name="`${key}_comapny_name`"
              class="col-md-8 form-control"
              type="text"
              v-model="experience.comapny_name"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has(`${key}_comapny_name`)"
                class="validation_message"
              >{{ errors.first(`${key}_comapny_name`) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label for="inputPassword" class="col-md-4 labels">
              পদবী
              <span class="required">*</span>
            </label>
            <input
              id="firstName"
              v-validate="{required:true}"
              data-vv-as="Post Held"
              :name="`${key}_post_held`"
              class="col-md-8 form-control"
              type="text"
              v-model="experience.post_held"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has(`${key}_post_held`)"
                class="validation_message"
              >{{ errors.first(`${key}_post_held`) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1">
          <p @click="removeExperience(key)" style="cursor:pointer">
            বাদ দিন
            <i class="far fa-trash-alt"></i>
          </p>
        </div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-3" for="#firstName">
              শুরু
              <span class="required">*</span>
            </label>
            <div class="col-md-9">
              <div style="padding:3px;">
                <VueCtkDateTimePicker
                  v-validate="{required:true}"
                  data-vv-as="Serve From"
                  :name="`${key}_serve_from`"
                  style="margin-left:18px;"
                  label="তারিখ নির্বাচন করুন"
                  v-model="experience.serve_from"
                  :only-date="true"
                />
              </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has(`${key}_serve_from`)"
                class="validation_message"
              >{{ errors.first(`${key}_serve_from`) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-3" for="#firstName">
              শেষ
              <span class="required">*</span>
            </label>
            <div class="col-md-9">
              <div style="padding:3px;">
                <VueCtkDateTimePicker
                  v-validate="{required:true}"
                  data-vv-as="Serve Till"
                  :name="`${key}_serve_till`"
                  style="margin-left:18px;"
                  label="তারিখ নির্বাচন করুন"
                  v-model="experience.serve_till"
                  :only-date="true"
                />
              </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has(`${key}_serve_till`)"
                class="validation_message"
              >{{ errors.first(`${key}_serve_till`) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label for="inputPassword" class="col-md-4 labels">সম্পর্কিত ব্যক্তি</label>
            <input
              id="firstName"
              name="Father Name"
              class="col-md-8 form-control"
              type="text"
              v-model="experience.contact_person"
            />
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label for="inputPassword" class="col-md-4 labels">
              ফোন/ মোবাইল
              <span class="required">*</span>
            </label>
            <input
              id="firstName"
              v-validate="{required:true}"
              data-vv-as="Phone/Mobile"
              :name="`${key}_phone`"
              class="col-md-8 form-control"
              type="text"
              v-model="experience.phone"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has(`${key}_phone`)"
                class="validation_message"
              >{{ errors.first(`${key}_phone`) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label for="inputPassword" class="col-md-4 labels">ইমেইল</label>
            <input
              id="firstName"
              name="Father Name"
              class="col-md-8 form-control"
              type="text"
              v-model="experience.email"
            />
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">দায়িত্ব</label>
            <textarea
              class="form-control col-md-8"
              v-model="experience.responsibility"
              id="exampleFormControlTextarea1"
              rows="2"
            ></textarea>
          </div>
        </div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">অর্জন</label>
            <textarea
              class="form-control col-md-8"
              v-model="experience.achievement"
              id="exampleFormControlTextarea1"
              rows="2"
            ></textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <button
            @click="addMoreExperience()"
            class="btn btn-secondary btn-sm"
          >আরও যোগ করুন</button>
        </div>
      </div>
    </tab-content>
     
    <tab-content title="প্রশিক্ষণ" :before-change="beforeSave" icon="fa fa-certificate">
      <div v-if="training_tab" v-for="(training,key) in trainings" :key="key" class="row">
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label for="inputPassword" class="col-md-4 labels">
              প্রশিক্ষনের নাম
              <span class="required">*</span>
            </label>
            <input
              id="firstName"
              v-validate="{required:true}"
              data-vv-as="Training Name"
              :name="`${key}_training_name`"
              class="col-md-8 form-control"
              type="text"
              v-model="training.training_name"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has(`${key}_training_name`)"
                class="validation_message"
              >{{ errors.first(`${key}_training_name`) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-3" for="#firstName">
              ট্রেনিং সেন্টার 
              <span class="required">*</span>
            </label>
            <div class="col-md-9">
              <div style="padding-left:6px;">
                <multiselect
                  style="margin-left:15px;"
                  v-validate="{required:true}"
                  data-vv-as="Training Center"
                  :name="`${key}_training_center`"
                  v-model="training.training_center"
                  placeholder="Select Training Center"
                  label="name"
                  track-by="id"
                  :options="training_centers"
                ></multiselect>
              </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has(`${key}_training_center`)"
                class="validation_message"
              >{{ errors.first(`${key}_training_center`) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1">
          <p @click="removeTraining(key)" style="cursor:pointer">
            বাদ দিন
            <i class="far fa-trash-alt"></i>
          </p>
        </div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label for="inputPassword" class="col-md-4 labels">
              সময়কাল
              <span class="required">*</span>
            </label>
            <input
              id="firstName"
              v-validate="{required:true}"
              data-vv-as="Duration"
              :name="`${key}_duration`"
              class="col-md-8 form-control"
              type="text"
              v-model="training.duration"
            />
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has(`${key}_duration`)"
                class="validation_message"
              >{{ errors.first(`${key}_duration`) }}</span>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5 align-self-center">
          <div class="form-group row">
            <label class="labels col-md-4" for="#firstName">
              বিশ্লেষন
              <span class="required">*</span>
            </label>
            <textarea
              v-validate="{required:true}"
              data-vv-as="Description"
              :name="`${key}_description`"
              v-model="training.description"
              class="form-control col-md-8"
              id="exampleFormControlTextarea1"
              rows="2"
            ></textarea>
            <div class="col-md-4"></div>
            <div class="col-md-8">
              <span
                v-if="errors.has(`${key}_description`)"
                class="validation_message"
              >{{ errors.first(`${key}_description`) }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <button @click="addMoreTraining" class="btn btn-secondary btn-sm">আরও যোগ করুন</button>
        </div>
      </div>
    </tab-content>
    <div class="loader"></div>
  </form-wizard>
</template>

<script>
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import Multiselect from 'vue-multiselect'
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker'
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css'
import { FormWizard, TabContent } from 'vue-form-wizard'
import * as VeeValidate from 'vee-validate'
import Antd from 'ant-design-vue';
import 'ant-design-vue/dist/antd.css';
import Vue from 'vue'
Vue.config.productionTip = false;
Vue.use(VeeValidate)
Vue.use(Antd)

export default {
  layout: 'default',
  props: [
    'countries',
    'districts',
    'desired_jobs',
    'divisions',
    'training_centers'
  ],
  components: {
    FormWizard,
    TabContent,
    Multiselect,
    VueCtkDateTimePicker
  },
  data() {
    return {
      error_message: '',
      address_tab: false,
      nominee_tab: false,
      education_tab: false,
      language_tab: false,
      experience_tab: false,
      training_tab: false,
      image: '',
      not_edit_image: 10,
      name: '',
      email: '',
      password: '',
      personal: {
        name: '',
        father_name: '',
        mother_name: '',
        spouse_name: '',
        nid: '',
        nationality: 'বাংলাদেশী',
        country: '',
        district: '',
        marital_status: '',
        sex: '',
        religion: '',
        weight: '',
        height: '',
        job: '',
        passport_no: '',
        passport_date: '',
        birth_date: '',
        no_son: '',
        no_daughter: ''
      },
      url: '',
      same_address: false,
      address2: {
        division: '',
        district: '',
        subdistrict: '',
        union: '',
        village: '',
        street: '',
        postoffice: '',
        phone: ''
      },
      address3: {
        division: '',
        district: '',
        subdistrict: '',
        union: '',
        village: '',
        street: '',
        postoffice: '',
        phone: ''
      },
      total2: {
        districts2: [],
        subdistricts2: [],
        unions2: []
      },
      total3: {
        districts2: [],
        subdistricts2: [],
        unions2: []
      },
      nominee: {
        address: '',
        phone: '',
        name: '',
        relation: ''
      },
      educations: [
        {
          degree: '',
          p_year: '',
          institute: '',
          board: '',
          subject: '',
          grade: ''
        }
      ],
      language_list: [],
      languages: [{ language: '', writing_skill: '', oral_skill: '' }],
      language: {},
      experiences: [
        {
          contact_name: '',
          post_held: '',
          serve_form: '',
          serve_till: '',
          address: '',
          phone: '',
          contact_person: '',
          email: '',
          responsibility: '',
          achievement: ''
        }
      ],
      trainings: [
        {
          training_name: '',
          training_center: '',
          duration: '',
          description: ''
        }
      ]
    }
  },
  methods: {
    errorRemove(){
      this.error_message = ''
    },
    onComplete: function() {
      try { 
        var data = {
          applicant: 'applicant',
          personal: this.personal,
          image: this.image,
          not_edit_image: this.not_edit_image,
          name: this.name,
          email:this.email,
          password:this.password,
          address2: this.address2,
          address3: this.address3,
          same_address: this.same_address,
          educations: this.educations,
          experiences: this.experiences,
          languages: this.languages,
          nominee: this.nominee,
          trainings: this.trainings,
          country_id:this.personal.country.id,
          division_id:this.address2.division.id,
          district_id:this.address2.district.id,
          subdistrict_id:this.address2.subdistrict.id,
          union_id:this.address2.union.id,
        }
        var self = this
        this.$axios
          .post('applicant-agency/', data)
          .then(response => {
            if(response.data.phone){
              this.$notify.success({
                title: 'Applicant Info',
                message: 'Succesfully Save'
              })
              self.$router.push('/verify/'+response.data.phone);
            }
            else{
              this.$notify.success({
                title: 'Applicant Info',
                message: 'Succesfully Save,Please verify your mail.'
              })
              self.$router.push('/login');
            }
            
          })
          .catch(error => {})
      }catch(error){}
    },
    beforeAddress() {
      var self = this
      this.address_tab = false
      this.nominee_tab = false
      this.education_tab = false
      this.language_tab = false
      this.experience_tab = false
      this.training_tab = false
      var data = {email:this.email}
      return new Promise((resolve, reject) => {
        this.$validator.validateAll().then(result => {
          this.$axios
          .post('applicant-agency/validation', data)
          .then(response => {
            resolve(result)
            if (result) {
              self.address_tab = true
            }
          })
          .catch(error => {
            self.error_message = error.response.data.error
            reject(error)
          })
        })
      })
    },
    beforeNominee() {
      var self = this
      this.nominee_tab = false
      this.education_tab = false
      this.language_tab = false
      this.experience_tab = false
      this.training_tab = false
      return new Promise((resolve, reject) => {
        this.$validator.validateAll().then(result => {
          resolve(result)
          if (result) {
            self.nominee_tab = true
          }
        })
      })
    },
    beforeEducation() {
      var self = this
      this.education_tab = false
      this.language_tab = false
      this.experience_tab = false
      this.training_tab = false
      return new Promise((resolve, reject) => {
        this.$validator.validateAll().then(result => {
          resolve(result)
          if (result) {
            self.education_tab = true
          }
        })
      })
    },
    beforeLanguage() {
      var self = this
      this.language_tab = false
      this.experience_tab = false
      this.training_tab = false
      return new Promise((resolve, reject) => {
        this.$validator.validateAll().then(result => {
          resolve(result)
            if (result) {
              self.language_tab = true
            }
        })
      })
    },
    beforeSave() {

      return new Promise((resolve, reject) => {
        this.$validator.validateAll().then(result => {
          resolve(result)
        })
      })
    },
    beforeExperience() {
      var self = this
      this.experience_tab = false
      this.training_tab = false
      return new Promise((resolve, reject) => {
        this.$validator.validateAll().then(result => {
          resolve(result)
            if (result) {
              self.experience_tab = true
            }
        })
      })
    },
    beforeTraining() {
      var self = this
      this.training_tab = false
      return new Promise((resolve, reject) => {
        this.$validator.validateAll().then(result => {
          resolve(result)
            if (result) {
              self.training_tab = true
            }
        })
      })
    },
    imageChanged(e) {
      var fileReader = new FileReader()
      fileReader.readAsDataURL(e.target.files[0])
      fileReader.onload = e => {
        this.image = e.target.result
        this.not_edit_image = 11
      }
      this.url = URL.createObjectURL(e.target.files[0])
    },
    RemoveImage: function() {
      this.image = ''
      this.not_edit_image = 10
      this.url = ''
    },
    sameAddress() {
      if (!this.same_address) {
        this.address3 = this.address2
      } else {
        this.address3 = {
          division: {},
          district: {},
          subdistrict: {},
          union: {},
          village: '',
          street: '',
          postoffice: '',
          phone: ''
        }
      }
    },
    async getDistrictByID2() {
      this.$axios
        .get('api/get-district/' + this.address2.division.id)
        .then(response => {
          this.total2.districts2 = response.data
        })
        .catch(error => {})
    },
    async getSubdistrict2() {
      this.$axios
        .get('api/get-subdistrict/' + this.address2.district.id)
        .then(response => {
          this.total2.subdistricts2 = response.data
        })
        .catch(error => {})
    },
    async getUnion2() {
      this.$axios
        .get('api/get-union/' + this.address2.subdistrict.id)
        .then(response => {
          this.total2.unions2 = response.data
        })
        .catch(error => {})
    },
    async getDistrictByID3() {
      this.$axios
        .get('api/get-district/' + this.address3.division.id)
        .then(response => {
          this.total3.districts2 = response.data
        })
        .catch(error => {})
    },
    async getSubdistrict3() {
      this.$axios
        .get('api/get-subdistrict/' + this.address3.district.id)
        .then(response => {
          this.total3.subdistricts2 = response.data
        })
        .catch(error => {})
    },
    async getUnion3() {
      this.$axios
        .get('api/get-union/' + this.address3.subdistrict.id)
        .then(response => {
          this.total3.unions2 = response.data
        })
        .catch(error => {})
    },
    addMoreEducation() {
      var data = {
        degree: '',
        p_year: '',
        institute: '',
        board: '',
        subject: '',
        grade: ''
      }
      this.educations.push(data)
    },
    removeEducation(index) {
      this.educations.splice(index, 1)
    },
    async getLanguage() {
      this.$axios
        .get('api/get-language')
        .then(response => {
          this.language_list = response.data
        })
        .catch(error => {})
    },
    addMoreLanguage() {
      var data = { language: '', writing_skill: '', oral_skill: '' }
      this.languages.push(data)
    },
    removeLanguage(index) {
      this.languages.splice(index, 1)
    },
    addMoreExperience() {
      var data = {
        contact_name: '',
        post_held: '',
        serve_form: '',
        serve_till: '',
        address: '',
        phone: '',
        contact_person: '',
        email: '',
        responsibility: '',
        achievement: ''
      }
      this.experiences.push(data)
    },
    removeExperience(index) {
      this.experiences.splice(index, 1)
    },
    addMoreTraining() {
      var data = {
        training_name: '',
        training_center: '',
        duration: '',
        description: ''
      }
      this.trainings.push(data)
    },
    removeTraining(index) {
      this.trainings.splice(index, 1)
    }
  },
  mounted() {
    this.getLanguage()
  }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
.required {
  color: red;
}
.logo_upload {
  border: 1px solid #ccc;
  width: 90%;
  height: 100px;
  background: #eceef0;
  text-align: center;
  cursor: pointer;
  margin-left: 45px;
}
.image_upload p {
  margin-top: 10px;
  font-size: 12px;
}

.image_upload i {
  font-size: 34px;
}
.removeImage {
  position: absolute;
  right: 13px;
  top: 14px;
  color: var(--white);
  border: 1px solid;
  border-radius: 25px;
  padding: 4px 8px;
  background-color: #fb1212f5;
  font-size: 10px;
  font-family: cursive;
}
.fitimage {
  width: 32%;
  height: 100%;
  -o-object-fit: contain;
  object-fit: contain;
  background-color: #e6e6ef;
}
</style>