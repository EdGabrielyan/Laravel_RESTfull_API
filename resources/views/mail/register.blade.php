<x-mail::message>
Hello! {{ $name }}

You are registered successfully

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
