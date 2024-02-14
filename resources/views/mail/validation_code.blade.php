
<x-mail::message>
    <div style="background-color: #f4f4f4; padding: 20px; font-family: Arial, sans-serif;">
        <p style="color: #666;"> مرحبا بك عزيزي</p>
        <p><strong>{{ $name }}</strong></p>
        <p style="color: #666;">هذا هو كود التفعيل للتسجيل</p>
        <p><strong>{{ $otp }}</strong></p>
        <p style="color: #666;">يرجى عدم مشاركة هذا الكود مع أي شخص.</p>
        <p style="color: #888;"> {{ config('app.name') }}</p>
    </div>
</x-mail::message>
