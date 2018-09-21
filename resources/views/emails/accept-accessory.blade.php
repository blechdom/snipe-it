@extends('emails/layouts/default')

@section('content')
<p>Hello {{ $first_name }},</p>


<p>A new item has been checked out under your name, details are below.</p>

<table>
	<tr>
		<td>
			Accessory Name:
		</td>
		<td>
			<strong>{{ $item_name }}</strong>
		</td>
	</tr>
	<tr>
		<td>
			Checkout Date:
		</td>
		<td>
			<strong>{{ $checkout_date }}</strong>
		</td>
	</tr>
	@if ($note)
		<tr>
			<td>
				Additional Notes:
			</td>
			<td>
				<strong>{{ $note }}</strong>
			</td>
		</tr>
	@endif
</table>

@if (($require_acceptance==1) && ($eula!=''))

	<br><b>Please read the terms of use below. If you have not received the accessory or do not agree to the terms of use, please reply to this email.
</b>
@elseif (($require_acceptance==1) && ($eula==''))

<br><b>	If you have not received the accessory or do not agree to the terms of use, please reply to this email.
</b>
@elseif (($require_acceptance==0) && ($eula!=''))

<br><b>	Please read the terms of use below.
</b>
@endif

</p>

<p><blockquote>{!! $eula !!}</blockquote></p>

@if ($require_acceptance==1)
<!-- <p><strong><a href="{{ config('app.url') }}/account/accept-asset/{{ $log_id }}">I have read and agree to the terms of use, and have received this item.</a></strong></p>
-->
@endif

<p>{{ \App\Models\Setting::getSettings()->site_name }}</p>
@stop
