@extends('layouts/default')

@section('title0')

    @if (Input::get('status'))
        @if (Input::get('status')=='Pending')
            {{ trans('general.pending') }}
        @elseif (Input::get('status')=='RTD')
            {{ trans('general.ready_to_deploy') }}
        @elseif (Input::get('status')=='Undeployable')
            {{ trans('general.undeployable') }}
        @elseif (Input::get('status')=='Deployable')
            {{ trans('general.deployed') }}
         @elseif (Input::get('status')=='Requestable')
            {{ trans('admin/hardware/general.requestable') }}
        @elseif (Input::get('status')=='Archived')
            {{ trans('general.archived') }}
         @elseif (Input::get('status')=='Deleted')
            {{ trans('general.deleted') }}
        @endif
    @else
            {{ trans('general.all') }}
    @endif

    {{ trans('general.assets') }}
@stop

{{-- Page title --}}
@section('title')
    @yield('title0')  @parent
@stop

{{-- Page content --}}
@section('content')
     <div class="row">
    <div class="col-md-12">
	   <div class="box">
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                @if (Input::get('status')!='Deleted')
		<div id="toolbar">
		</div>
                  @endif


                <table
                name="assets"
                {{-- data-row-style="rowStyle" --}}
                data-toolbar="#toolbar"
                class="table table-striped"
                id="table"
                data-url="{{route('api.hardware.list', array(''=>e(Input::get('status')),'order_number'=>e(Input::get('order_number'))))}}"
                data-cookie="true"
                data-click-to-select="true"
                data-cookie-id-table="{{ e(Input::get('status')) }}assetTable-{{ config('version.hash_version') }}">
                    <thead>
                        <tr>
                            <th data-sortable="true" data-field="category_account" data-searchable="true" data-visible="true">{{ trans('general.category_account') }}</th>
			    <th data-sortable="true" data-field="image" data-visible="true">{{ trans('admin/hardware/table.image') }}</th>
                            <th data-sortable="true" data-field="name_account" data-visible="true">{{ trans('admin/hardware/form.name_account') }}</th>
		            <th data-sortable="true" data-field="manufacturer_nolink" data-visible="true"  data-searchable="true">{{ trans('admin/hardware/table.manufacturer_nolink') }}</th>
                            <th data-sortable="true" data-field="asset_tag_account" data-visible="true">{{ trans('admin/hardware/table.asset_tag_account') }}</th>
			    <th data-sortable="true" data-field="status_label" data-visible="true">{{ trans('admin/hardware/table.status') }}</th>
                            <th data-visible="true" data-field="request_action">{{ trans('admin/hardware/table.request_action') }}</th>
                        </tr>
                    </thead>
                </table>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- ./box-body -->
        </div><!-- /.box -->
    </div>


</div>


@section('moar_scripts')
<script src="{{ asset('assets/js/bootstrap-table.js') }}"></script>
<script src="{{ asset('assets/js/extensions/cookie/bootstrap-table-cookie.js') }}"></script>
<script src="{{ asset('assets/js/extensions/mobile/bootstrap-table-mobile.js') }}"></script>
<script src="{{ asset('assets/js/extensions/export/bootstrap-table-export.js') }}"></script>
<script src="{{ asset('assets/js/extensions/export/tableExport.js') }}"></script>
<script src="{{ asset('assets/js/extensions/export/jquery.base64.js') }}"></script>
<script src="{{ asset('assets/js/extensions/multiple-sort/bootstrap-table-multiple-sort.js') }}"></script>
<script type="text/javascript">


    $('#table').bootstrapTable({
        classes: 'table table-responsive table-no-bordered',
        undefinedText: '',
        iconsPrefix: 'fa',
        showRefresh: false,
        search: true,
        pageSize: 100,
        pagination: true,
        sidePagination: 'server',
        sortable: true,
        showMultiSort: false,
        cookie: true,
        cookieExpire: '2y',
        mobileResponsive: true,
        showExport: false,
        showColumns: false,
        exportDataType: 'all',
        exportTypes: ['csv', 'excel', 'txt','json', 'xml'],
        maintainSelected: true,
        paginationFirstText: "{{ trans('general.first') }}",
        paginationLastText: "{{ trans('general.last') }}",
        paginationPreText: "{{ trans('general.previous') }}",
        paginationNextText: "{{ trans('general.next') }}",
        pageList: ['10','25','50','100','150','200','500','1000'],
        exportOptions: {
            fileName: 'assets-export-' + (new Date()).toISOString().slice(0,10),
        },
        icons: {
            paginationSwitchDown: 'fa-caret-square-o-down',
            paginationSwitchUp: 'fa-caret-square-o-up',
            sort: 'fa fa-sort-amount-desc',
            plus: 'fa fa-plus',
            minus: 'fa fa-minus',
            columns: 'fa-columns',
            refresh: 'fa-refresh'
        },

    });


    // $('#toolbar').find('select').change(function () {
    //     $table.bootstrapTable('refreshOptions', {
    //         exportDataType: $(this).val()
    //     });
    // });


</script>
@stop

@stop
