@extends('layouts/default')

{{-- Page title --}}
@section('title')
Categories
@parent
@stop



{{-- Page content --}}
@section('content')


<div class="row">
  <div class="col-md-12">
    <div class="box box-default">
      <div class="box-body">
        <div class="table-responsive">

          <table
          class="table table-striped"
          name="categories"
          id="table"
          data-url="{{route('api.categories_account.list') }}"
          data-cookie="true"
          data-click-to-select="true"
          data-cookie-id-table="categoriesTable-{{ config('version.hash_version') }}">
            <thead>
              <tr>
                <th data-sortable="true" data-field="name_account" data-visible="true">{{ trans('admin/categories/table.name_account') }}</th>
                <th data-sortable="true" data-field="category_type" data-visible="true">{{ trans('general.type') }}</th>
                <th data-searchable="false" data-sortable="false" data-field="count" data-visible="true">{{ trans('general.assets') }}</th>
              </tr>
            </thead>
          </table>

        </div>
      </div><!-- /.box-body -->
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
<script type="text/javascript">
    $('#table').bootstrapTable({
        classes: 'table table-responsive table-no-bordered',
        undefinedText: '',
        iconsPrefix: 'fa',
        showRefresh: false,
        search: true,
        pageSize: {{ \App\Models\Setting::getSettings()->per_page }},
        pagination: true,
        sidePagination: 'server',
        sortable: true,
        cookie: true,
        cookieExpire: '2y',
        mobileResponsive: true,
        showExport: false,
        showColumns: false,
        exportDataType: 'all',
        exportTypes: ['csv', 'txt','json', 'xml'],
        exportOptions: {
            fileName: 'categories-export-' + (new Date()).toISOString().slice(0,10),
        },
        maintainSelected: true,
        paginationFirstText: "{{ trans('general.first') }}",
        paginationLastText: "{{ trans('general.last') }}",
        paginationPreText: "{{ trans('general.previous') }}",
        paginationNextText: "{{ trans('general.next') }}",
        pageList: ['10','25','50','100','150','200'],
        icons: {
            paginationSwitchDown: 'fa-caret-square-o-down',
            paginationSwitchUp: 'fa-caret-square-o-up',
            columns: 'fa-columns',
            refresh: 'fa-refresh'
        },

    });
</script>
@stop
@stop
