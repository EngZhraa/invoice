@extends('layouts.master')
<title>
    العقود
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
                    العقود</span>
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
                            data-toggle="modal" href="#modaldemo8">اضافة عقد</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-striped mg-b-0 text-md-nowrap ">
                        <thead>
                            <tr>

                                <th class="border-bottom-0">اسم المشروع</th>
                                <th class="border-bottom-0">رقم العقد</th>
                                <th class="border-bottom-0">مبلغ العقد</th>
                                <th class="border-bottom-0">نوع العقد</th>
                                <th class="border-bottom-0">الشركة المنفذة</th>
                                <th class="border-bottom-0">تاريخ توقيع العقد</th>
                                <th class="border-bottom-0">تاريخ انتهاء العقد</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($contracts as $contract)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{ $contract->finance->fin_id }}</td>
                                    <td>{{ $contract->cont_num }}</td>
                                    <td>{{ $contract->full_amnt_cont }}</td>
                                    <td>{{ $contract->finn_type }}</td>
                                    <td>{{ $contract->company->comp_name }}</td>
                                    <td>{{ $contract->cont_date }}</td>
                                    <td>{{ $contract->cont_end_date }}</td>
                                    <td>
                                        <button class="btn btn-outline-success btn-lg" data-id="{{ $contract->id }}"
                                            data-fin_id="{{ $contract->finance->fin_id }}"
                                            data-cont_num="{{ $contract->cont_num }}"
                                            data-full_amnt_cont="{{ $contract->full_amnt_cont }}"
                                            data-finn_type="{{ $contract->finn_type }}"
                                            data-comp_name="{{ $contract->company->id }}"
                                            data-cont_date="{{ $contract->cont_date }}"
                                            data-cont_end_date="{{ $contract->cont_end_date }}" data-toggle="modal"
                                            data-target="#edit_con">تعديل</button>


                                        <button class="btn btn-lg btn-outline-danger" data-id="{{ $contract->id }}"
                                            data-fin_id="{{ $contract->fin_id }}" data-toggle="modal"
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
                    <h6 class="modal-title">اضافة عقد</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('contracts.store') }}" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="Value_Status" id="Value_Status" value="1">
                        <div class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <label for="finance">اسم المشروع </label>
                            <select id="finance" class="form-select form-select-lg mb-3"
                                aria-label=".form-select-lg example" name="fin_id">7
                                <option value="">اختر المشروع</option>
                                @foreach ($finances as $finance)
                                    <option value="{{ $finance->id }}">{{ $finance->proj_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> تاريخ العقد</label>
                            <input type="date" placeholder=" تاريخ العقد " class="form-control" id="cont_date"
                                name="cont_date">
                        </div>
                        <div class="form-group">
                            </label for="exampleInputEmail1">رقم العقد</label>
                            <input type="text" class="form-control" placeholder="رقم العقد" name="cont_num">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">المبلغ الكلي</label>
                        </div>
                        <div class="col-md-9 ">
                            <input type="text" class="form-control" placeholder="المبلغ الكلي" name="full_amnt_cont">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> نوع العملة</label>
                            <div class="col-md-9">
                                <select class="form-select" name="finn_type">
                                    <option value="">اختر نوع العملة</option>
                                    <option value="دولار">دولار</option>
                                    <option value="دينار">دينار</option>
                                    <option value="ين">ين</option>
                                    <option value="اخرى">اخرى</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">تاريخ انتهاء العقد</label>
                            <div class="col-md-9">
                                <input type="date" class="form-control" 
                                    placeholder="تاريخ انتهاء العقد" name="cont_end_date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">الشركة المنفذة</label>
                            <div class="col-md-9">
                                <select class="form-select" name="excut_comp">
                                    <option value="">اختر الشركة</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->comp_id }}">{{ $company->comp_name }}</option>
                                    @endforeach
                                </select>
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
                        <input type="hidden" name="Value_Status" id="Value_Status" value="1">
                        <div class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                            <label for="finance">اسم المشروع </label>
                            <select id="finance" class="form-select form-select-lg mb-3"
                                aria-label=".form-select-lg example" name="benifit_comp_id">
                                <option value="">اختر المشروع</option>
                                @foreach ($finances as $finance)
                                    <option value="{{ $finance->id }}">{{ $finance->fin_id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> تاريخ العقد</label>
                            <input type="date" placeholder=" تاريخ العقد " class="form-control" id="cont_date"
                                name="cont_date">
                        </div>
                        <div class="form-group">
                            </label for="exampleInputEmail1">رقم العقد</label>
                            <input type="text" class="form-control" placeholder="رقم العقد" name="cont_num">
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">الكلفة</label>
                            <input type="text" class="form-control" placeholder="الكلفة" name="finn_type">
                            <input type="hidden" name="Value_Status" value="1">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">المبلغ الكلي</label>
                        </div>
                        <div class="col-md-9 ">
                            <input type="text" class="form-control" placeholder="المبلغ الكلي" name="full_amnt_cont">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> نوع العملة</label>
                            <div class="col-md-9">
                                <select class="form-select" name="finn_type">
                                    <option value="">اختر نوع العملة</option>
                                    <option value="دولار">دولار</option>
                                    <option value="دينار">دينار</option>
                                    <option value="ين">ين</option>
                                    <option value="اخرى">اخرى</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">تاريخ انتهاء العقد</label>
                            <div class="col-md-9">
                                <input type="date" class="form-control" 
                                    placeholder="تاريخ انتهاء العقد" name="cont_end_date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">الشركة المنفذة</label>
                            <div class="col-md-9">
                                <select class="form-select" name="excut_comp">
                                    <option value="">اختر الشركة</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->comp_id }}">{{ $company->comp_name }}</option>
                                    @endforeach
                                </select>
                                
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
                    <form action="contracts/destroy" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="id" id="id" value="">
                            <input class="form-control" name="cont_num" id="cont_num" type="text" readonly>
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
            var fin_id = button.data('fin_id')
            var cont_date = button.data('cont_date')
            var cont_num = button.data('cont_num')
            var finn_type = button.data('finn_type')
            var full_amnt_cont = button.data('full_amnt_cont')
            var cont_end_date = button.data('cont_end_date')
            var excut_comp = button.data('excut_comp')
           

            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #fin_id').val(fin_id);
            modal.find('.modal-body #cont_date').val(cont_date);
            modal.find('.modal-body #cont_num').val(cont_num);
            modal.find('.modal-body #finn_type').val(finn_type);
            modal.find('.modal-body #full_amnt_cont').val(full_amnt_cont);
            modal.find('.modal-body #cont_end_date').val(cont_end_date);
            modal.find('.modal-body #excut_comp').val(excut_comp);
          
        })
        $('#modaldemo9').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget)
            var id = button.data('id')
            var fin_id = button.data('fin_id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #cont_num').val(cont_num);

        })
    </script>
@endsection
