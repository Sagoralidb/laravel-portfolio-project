<x-mail::message>
# Introduction:Mail form your protfolio
<h3>New message from {{ $contac_form_data['email'] }}</h3>
<p>Name:{{ $contac_form_data['name'] }} </p>
<p>Phone:{{ $contac_form_data['phone'] }} </p>
<p>Message:{{ $contac_form_data['message'] }} </p>
<x-mail::button :url="''">
    Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
