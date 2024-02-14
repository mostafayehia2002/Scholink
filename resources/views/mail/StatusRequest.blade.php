<x-mail::message>
    مرحبا بك {{$user->parent_name}}
    @if($status=='reject')
        تم رفض الطلب المقدم منك
        الخاص بالابن {{$user->child_name}}
    @elseif($status=='accept')
        تم قبول طلبك الخاص بالابن {{$data['student']->name}}

        : البريد الخاص بالاب {{$data['parent']->email}}
        الرقم السري  : {{$data['parent']->national_id}}
        ====================================================
        : البريد الخاص بالابن {{$data['student']->email}}
        الرقم السري : 123456
        ================================================
        الفصل الدراسي {{$data['class']->level ."-". $data['class']->class_name }}
    @endif

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
