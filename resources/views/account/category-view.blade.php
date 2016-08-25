@extends('layouts/default')

{{-- Page title --}}
@section('title')
 {{ $category->name }}
  Category
@parent
@stop

{{-- Page content --}}
@section('content')


  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-body">
          <table
          name="category_assets"
          id="table"
          data-url="{{ route('api.categories.'.$category->category_type.'.view', [$category->id, $category->category_type]) }}"
          data-cookie="true"
          data-click-to-select="true"
          data-cookie-id-table="categoryAssetsTable">
              <thead>
                  <tr>
                      @if ($category->category_type=='asset')
			    <th data-sortable="true" data-field="image" data-visible="true">{{ trans('admin/hardware/table.image') }}</th>
                            <th data-sortable="true" data-field="name_account" data-visible="true">{{ trans('admin/hardware/form.name_account') }}</th>
                            <th data-sortable="true" data-field="manufacturer_nolink" data-visible="true"  data-searchable="true">{{ trans('admin/hardware/table.manufacturer_nolink') }}</th>
                            <th data-sortable="true" data-field="asset_tag_account">{{ trans('admin/hardware/table.asset_tag_account') }}</th>
                            <th data-sortable="true" data-field="status_label">{{ trans('admin/hardware/table.status') }}</th>
			<th data-visible="true" data-field="request_action">{{ trans('admin/hardware/table.request_action') }}</th>
			@elseif ($category->category_type=='accessory')
			    <th data-searchable="true" data-sortable="true" data-field="name_nolink" data-visible="true">{{ trans('general.name') }}</th>
			 <th data-searchable="false" data-sortable="false" data-field="qty">{{ trans('admin/accessories/general.total') }}</th>
                  <th data-searchable="false" data-sortable="false" data-field="numRemaining">{{ trans('admin/accessories/general.remaining') }}</th>	
			 @else ($category->category_type=='consumable')
                            <th data-searchable="true" data-sortable="true" data-field="name_nolink" data-visible="true">{{ trans('general.name') }}</th>
		 <th data-sortable="true" data-field="manufacturer_nolink" data-visible="true">{{ trans('general.manufacturer') }}</th>
                <th data-sortable="true" data-field="model" data-visible="true">{{ trans('general.model_no') }}</th>
		<th data-switchable="false" data-searchable="false" data-sortable="false" data-visible="true" data-field="qty_consumable"> {{ trans('admin/consumables/general.total') }}</th>
                <th data-switchable="false" data-searchable="false" data-sortable="false" data-field="numRemaining"> {{ trans('admin/consumables/general.remaining') }}</th>	
		@endif
		 </tr>
              </thead>
          </table>
        </div>
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
          mobileResponsive: true,
          showExport: false,
          showColumns: false,
          exportDataType: 'all',
          exportTypes: ['csv', 'txt','json', 'xml'],
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
