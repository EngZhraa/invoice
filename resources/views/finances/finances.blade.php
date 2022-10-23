@extends('layouts.master')
<title>
    المشاريع
</title>


@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css-rtl/style.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">التفاصيل</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    المشاريع</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- row -->
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">


                    <div class="col-sm-6 col-md-4 col-xl-3">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#modaldemo8">اضافة مشروع</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-striped mg-b-0 text-md-nowrap ">
                        <thead>
                            <tr>
                                <th class="border-bottom-0"> التسلسل</th>
                                <th class="border-bottom-0">اسم المشروع</th>
                                <th class="border-bottom-0">سنة التخصيص</th>
                                <th class="border-bottom-0">الكلفة</th>
                                <th class="border-bottom-0">نوع التمويل</th>
                                <th class="border-bottom-0">الجهة المستفيدة </th>
                                <th class="border-bottom-0">تبويب حسابي</th>
                                <th class="border-bottom-0">تخصيص التبويب (العملة المحلية )</th>
                                <th class="border-bottom-0">( تخصيص التبويب (العملة الاجنبية</th>
                                <!-- <th class="border-bottom-0">الملاحظات</th> -->
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($finances as $finance)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{ $finance->id }}</td>
                                    <td>{{ $finance->proj_name }}</td>
                                    <td>{{ $finance->assig_year }}</td>
                                    <td>{{ $finance->proj_cost }}</td>
                                    <td>{{ $finance->fina_type }}</td>
                                    <td>{{ $finance->gover->gov_name }}</td>
                                    <td>{{ $finance->fina_classfic }}</td>
                                    <td>{{ $finance->fina_amnt_loc }}</td>
                                    <td>{{ $finance->fina_amnt_for }}</td>
                                    <!-- <td>{{ $finance->notes }}</td> -->
                                    <td>
                                        <button class="btn btn-outline-success btn-lg" data-id="{{ $finance->id }}"
                                            data-proj_name="{{ $finance->proj_name }}"
                                            data-assig_year="{{ $finance->assig_year }}"
                                            data-proj_cost="{{ $finance->proj_cost }}"
                                            data-fina_type="{{ $finance->fina_type }}"
                                            data-gov_name="{{ $finance->gover->id }}"
                                            data-fina_classfic="{{ $finance->fina_classfic }}"
                                            data-fina_amnt_loc="{{ $finance->fina_amnt_loc }}"
                                            data-fina_amnt_for="{{ $finance->fina_amnt_for }}"
                                            data-notes="{{ $finance->notes }}" data-toggle="modal"
                                            data-target="#edit_fin">تعديل</button>


                                        <button class="btn btn-lg btn-outline-danger" data-id="{{ $finance->id }}"
                                            data-proj_name="{{ $finance->proj_name }}" data-toggle="modal"
                                            data-target="#modaldemo9">حذف</button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modaldemo8">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة مشروع</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('finances.store') }}" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id" value="">
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم المشروع</label>
                            <input type="text" placeholder=" اسم المشروع" class="form-control" id="proj_name"
                                name="proj_name">
                        </div>
                        <div class="form-group">
                            </label for="exampleInputEmail1">سنة التخصيص</label>
                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"
                                name="assig_year">
                                <option>اختر السنة </option>
                                @for ($year = date('y') - 10; $year < date('y') + 10; $year++)
                                    <option value="{{ $year + 2000 }}"> {{ $year + 2000 }} </option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <label for="gover">الجهة المستفيدة </label>
                            <select id="gover" class="form-select form-select-lg mb-3"
                                aria-label=".form-select-lg example" name="benifit_comp_id">
                                <option value="">اختر الدائرة</option>
                                @foreach ($govers as $gover)
                                    <option value="{{ $gover->id }}">{{ $gover->gov_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">الكلفة</label>
                            <input type="text" class="form-control" placeholder="الكلفة" name="proj_cost">
                            <input type="hidden" name="Value_Status" value="1">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">نوع التمويل</label>
                            <select class="form-select" name="fina_type">
                                <option value="">اختر نوع التمويل</option>
                                <option value="استثماري">استثماري</option>
                                <option value="استثماري">تشغيلي</option>
                                <option value="قروض">قروض</option>
                                <option value="اخرى">اخرى</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">التبويب الحسابي </label>
                            <input type="text" class="form-control" placeholder="التبويب الحسابي"
                                name="fina_classfic">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> تخصيص التبويب (العملة المحلية)</label>
                            <input type="text" class="form-control" placeholder="تخصيص التبويب (العملة المحلية)"
                                name="fina_amnt_loc">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> تخصيص التبويب (العملة الاجنبية) </label>
                            <input type="text" class="form-control" placeholder="تخصيص التبويب (العملة الاجنبية)"
                                name="fina_amnt_for">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">الملاحظات</label>
                            <input type="text" class="form-control" placeholder="الملاحظات" name="notes">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit_fin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل المشروع</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="finances/update" method="post" autocomplete="off">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id" value="">

                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم المشروع</label>
                            <input type="text" placeholder=" اسم المشروع" class="form-control" id="proj_name"
                                name="proj_name">
                        </div>
                        <div class="form-group">
                            </label for="exampleInputEmail1">سنة التخصيص</label>
                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"
                                name="assig_year" id="assig_year">
                                <option>اختر السنة </option>
                                @for ($year = date('y') - 10; $year < date('y') + 10; $year++)
                                    <option value="{{ $year + 2000 }}"> {{ $year + 2000 }} </option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <label for="benifit_comp_id">الجهة المستفيدة </label>
                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"
                                id="benifit_comp_id" name="benifit_comp_id">
                                <option value="">اختر الدائرة</option>
                                @foreach ($govers as $gover)
                                    <option value="{{ $gover->id }}">{{ $gover->gov_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">الكلفة</label>
                            <input type="text" class="form-control" placeholder="الكلفة" id="proj_cost"
                                name="proj_cost">
                            <input type="hidden" name="Value_Status" value="1">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">نوع التمويل</label>
                            <select class="form-select" id="fina_type" name="fina_type">
                                <option value="">اختر نوع التمويل</option>
                                <option value="استثماري">استثماري</option>
                                <option value="استثماري">تشغيلي</option>
                                <option value="قروض">قروض</option>
                                <option value="اخرى">اخرى</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">التبويب الحسابي </label>
                            <input type="text" class="form-control" placeholder="التبويب الحسابي" id="fina_classfic"
                                name="fina_classfic">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> تخصيص التبويب (العملة المحلية)</label>
                            <input type="text" class="form-control" placeholder="تخصيص التبويب (العملة المحلية)"
                                id="fina_amnt_loc" name="fina_amnt_loc">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> تخصيص التبويب (العملة الاجنبية) </label>
                            <input type="text" class="form-control" placeholder="تخصيص التبويب (العملة الاجنبية)"
                                id="fina_amnt_for" name="fina_amnt_for">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">الملاحظات</label>
                            <input type="text" class="form-control" placeholder="الملاحظات" id="notes"
                                name="notes">


                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- delete -->
    <div class="modal fade" id="modaldemo9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف المشروع</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="finances/destroy" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div  class="form-group">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control" name="proj_name" id="proj_name" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>  
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    



    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->

    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>



    <script>
        $('#edit_fin').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
           
            var id = button.data('id')
            
            var proj_name = button.data('proj_name')
            var assig_year = button.data('assig_year')
            var gov_name = button.data('gov_name')
            var proj_cost = button.data('proj_cost')
            var fina_type = button.data('fina_type')
            var fina_classfic = button.data('fina_classfic')
            var fina_amnt_loc = button.data('fina_amnt_loc')
            var fina_amnt_for = button.data('fina_amnt_for')
            var notes = button.data('notes')

            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #proj_name').val(proj_name);
            modal.find('.modal-body #assig_year').val(assig_year);
            modal.find('.modal-body #benifit_comp_id').val(gov_name);
            modal.find('.modal-body #proj_cost').val(proj_cost);
            modal.find('.modal-body #fina_type').val(fina_type);
            modal.find('.modal-body #fina_classfic').val(fina_classfic);
            modal.find('.modal-body #fina_amnt_loc').val(fina_amnt_loc);
            modal.find('.modal-body #fina_amnt_for').val(fina_amnt_for);
            modal.find('.modal-body #notes').val(notes);
        })
        $('#modaldemo9').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget)
            var id = button.data('id')
            var proj_name= button.data('proj_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #proj_name').val(proj_name);

        })
    </script>
@endsection
