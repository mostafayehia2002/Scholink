<x-mail::message>
    مرحبا بك {{$user->parent_name}}

    {{$message}}

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
