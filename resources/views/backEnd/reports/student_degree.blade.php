@extends('backEnd.master')
@section('mainContent')
    <input type="text" hidden value="{{ @$clas->class_name }}" id="cls">
    <input type="text" hidden value="{{ @$clas->section_name->sectionName->section_name }}" id="sec">
    <section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.student_report') </h1>
                <div class="bc-pages">
                    <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.reports')</a>
                    <a href="#">@lang('lang.student_report')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30" >@lang('lang.select_criteria')</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @if(session()->has('message-success') != "")
                        @if(session()->has('message-success'))
                            <div class="alert alert-success">
                                {{ session()->get('message-success') }}
                            </div>
                        @endif
                    @endif
                    <div class="white-box">
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student_degree_report', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                        <div class="row">
                            <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                            <div class="col-lg-2 mt-30-md">
                                <select class="w-100 niceSelect bb form-control {{ $errors->has('student') ? ' is-invalid' : '' }}" id="select_student" name="student">
                                    <option data-display="@lang('select student') " value="">@lang('select student')</option>
                                    @foreach( $students as $student)
                                        <option value="{{$student->id}}" {{isset($student_id)? ($student->id == $student_id? 'selected':''):''}}>{{$student->full_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('student'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('student') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-lg-3 mt-30-md">
                                <select class="w-100 niceSelect bb form-control {{ $errors->has('faculty') ? ' is-invalid' : '' }}" id="select_faculty" name="faculty">
                                    <option data-display="@lang('select faculty') " value="">@lang('select faculty')</option>
                                    @foreach($faculties as $faculty)
                                        <option value="{{@$faculty->id}}"  {{isset($faculty_id)? ($faculty_id == $faculty->faculty_name? 'selected':''):''}}>{{@$faculty->faculty_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('faculty'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('faculty') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-lg-2 mt-30-md" id="select_major_div">
                                <select class="w-100 niceSelect bb form-control{{ $errors->has('current_major') ? ' is-invalid' : '' }}" id="select_major" name="major">
                                    <option data-display="@lang('select major') " value="">@lang('select major')</option>
                                </select>
                            </div>

                            <div class="col-lg-2 sm_mb_20 sm2_mb_20 md_mb_20">
                                <select class="niceSelect w-100 bb form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                    <option data-display="@lang('lang.select') @lang('lang.class') " value="">@lang('lang.select') @lang('lang.class')</option>
                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}" {{isset($class_id)? ($class->id == $class_id? 'selected':''):''}}>{{$class->class_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('class'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('class') }}</strong></span>
                                @endif
                            </div>

                            <div class="col-lg-2 mt-30-md" id="select_section_div">
                                <select class="w-100 niceSelect bb form-control{{ $errors->has('current_section') ? ' is-invalid' : '' }}" id="select_section" name="section">
                                    <option data-display="@lang('lang.select_section')" value="">@lang('lang.select_section')</option>
                                </select>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-lg-2 mt-30-md">
                                <div class="input-effect sm2_mb_20 md_mb_20">
                                    <select class="niceSelect w-100 bb form-control{{ $errors->has('academic_year') ? ' is-invalid' : '' }}" name="academic_year">
                                        <option data-display="@lang('lang.academic_year')" value="">@lang('lang.academic_year') *</option>
                                        @foreach($academic_years as $academic_year)
                                            <option value="{{$academic_year->id}}" {{old('academic_year') == $academic_year->id? 'selected': ''}}>{{$academic_year->year}}-{{$academic_year->year+1}}</option>
                                        @endforeach
                                    </select>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('academic_year'))
                                        <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('academic_year') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="col-lg-2 mt-30-md" id="select_semester_div">
                                <select class="w-100 niceSelect bb form-control{{ $errors->has('current_section') ? ' is-invalid' : '' }}" id="select_semester" name="semester">
                                    <option data-display="@lang('lang.select_semester')" value="">@lang('lang.select_semester')</option>
                                </select>
                            </div>

                            <div class="col-lg-2 mt-30-md">
                                <select class="w-100 niceSelect bb form-control {{ $errors->has('generation') ? ' is-invalid' : '' }}" id="select_generation" name="generation">
                                    <option data-display="@lang('select generation') " value="">@lang('select generation')</option>
                                    @foreach($generations as $generation)
                                        <option value="{{$generation->generation_name}}"  {{isset($generation_id)? ($generation_id == $generation->generation_name? 'selected':''):''}}>{{$generation->generation_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('generation'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('generation') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-lg-2 mt-30-md">
                                <select class="w-100 niceSelect bb form-control {{ $errors->has('degree') ? ' is-invalid' : '' }}" id="select_degree" name="degree">
                                    <option data-display="@lang('select student type') " value="">@lang('select student type')</option>
                                    <option value="A">????????????????????????????????????</option>
                                    <option value="A">????????????????????????????????????</option>
                                    <option value="A">??????????????????????????????????????????????????????????????????</option>
                                    <option value="A">??????????????????????????????????????????????????????</option>
                                    <option value="A">??????????????????????????????????????????</option>
{{--                                    @foreach($generations as $generation)--}}
{{--                                        <option value="{{$generation->name}}"  {{isset($generation_id)? ($generation_id == $generation->name? 'selected':''):''}}>{{$generation->name}}</option>--}}
{{--                                    @endforeach--}}
                                </select>
                                @if ($errors->has('generation'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong>{{ $errors->first('generation') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-lg-2 mt-30-md">
                                <select class="w-100 niceSelect bb form-control {{ $errors->has('semester') ? ' is-invalid' : '' }}" id="select_academic_year" name="semester">
                                    <option data-display="@lang('select semester') " value="">@lang('select semester')</option>

                                </select>
                                @if ($errors->has('semester'))
                                    <span class="invalid-feedback invalid-select" role="alert">
                                            <strong>{{ $errors->first('semester') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="col-lg-2 mt-30-md">
                                <select class="w-100 niceSelect bb form-control{{ $errors->has('current_section') ? ' is-invalid' : '' }}" name="type">
                                    <option data-display="@lang('lang.select_type')" value="">@lang('lang.select_type')</option>
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}" {{isset($type_id)? ($type_id == $type->id? 'selected':''):''}}>{{$type->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2 mt-30-md">
                                <select class="w-100 niceSelect bb form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender">
                                    <option data-display="@lang('lang.select_gender')" value="">@lang('lang.select_gender')</option>
                                    @foreach($genders as $gender)
                                        <option value="{{$gender->id}}" {{isset($gender_id)? ($gender_id == $gender->id? 'selected':''):''}}>{{$gender->base_setup_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12 mt-20 text-right">
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti-search pr-2"></span>
                                    @lang('lang.search')
                                </button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

            @if(isset($students))

                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'method' => 'POST', 'enctype' => 'multipart/form-data'])}}

                <div class="row mt-40">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 no-gutters">
                                <div class="main-title">
                                    <h3 class="mb-0">@lang('lang.student_report')</h3>
                                </div>
                            </div>
                        </div>



                        <!-- <div class="d-flex justify-content-between mb-20"> -->
                    <!-- <button type="submit" class="primary-btn fix-gr-bg mr-20" onclick="javascript: form.action='{{url('student-attendance-holiday')}}'">
                            <span class="ti-hand-point-right pr"></span>
                            mark as holiday
                        </button> -->


                        <!-- </div> -->
                        <div class="row">
                            <div class="col-lg-12 ">

                                <table id="table_ids" class="display school-table" cellspacing="0" width="100%">
                                    <thead>
                                    @if(session()->has('message-danger') != "")
                                        <tr>
                                            <td colspan="9">
                                                @if(session()->has('message-danger'))
                                                    <div class="alert alert-danger">
                                                        {{ session()->get('message-danger') }}
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th>@lang('lang.class')</th>
                                        <th>@lang('lang.section')</th>
                                        <th>@lang('lang.admission') @lang('lang.no')</th>
                                        <th>@lang('lang.name')</th>
                                        <th>@lang('lang.father_name')</th>
                                        <th>@lang('lang.date_of_birth')</th>
                                        <th>@lang('lang.gender')</th>
                                        <th>@lang('lang.type')</th>
                                        <th>@lang('lang.phone')</th>
                                        <th>@lang('lang.nid') @lang('lang.no')</th>
                                        <th>@lang('lang.Birth_Certificate_Number')</th>
                                        <th>@lang('lang.action')</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>@php if(!empty($student->class)){ echo $student->class->class_name; }else { echo ''; } @endphp</td>
                                            <td>{{$student->section != ""? $student->section->section_name:""}}</td>
                                            <td>{{$student->admission_no}}</td>
                                            <td>{{$student->first_name.' '.$student->last_name}}</td>
                                            <td>{{$student->parents !=""?$student->parents->fathers_name:""}}</td>
                                            <td>

                                                {{$student->date_of_birth != ""? App\SmGeneralSettings::DateConvater($student->date_of_birth):''}}

                                            </td>
                                            <td>{{$student->gender != ""? $student->gender->base_setup_name:""}}</td>
                                            <td>{{$student->category != ""? $student->category->category_name:""}}</td>
                                            <td>{{$student->mobile}}</td>
                                            <td>{{$student->national_id_no}}</td>
                                            <td>{{$student->local_id_no}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                        @lang('lang.select')
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        @if(in_array(1000, App\GlobalVariable::GlobarModuleLinks()) || Auth::user()->role_id == 1 )
                                                            <a class="dropdown-item" href="{{route('register_student', [$student->id])}}">@lang('lang.view')</a>
                                                        @endif

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tr>
                                        <th colspan="2"></th>
                                        <th style="color: #000000;font-size: 25px">Total</th>
                                        <th style="color: #000000;font-size: 25px">{{count($students)}}</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>

            @endif

        </div>
    </section>


@endsection
