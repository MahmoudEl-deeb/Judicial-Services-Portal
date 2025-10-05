<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>تفاصيل الطلب</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('{{ storage_path('fonts/DejaVuSans.ttf') }}') format('truetype');
        }
        body {
            font-family: 'DejaVu Sans', 'sans-serif';
        }
    </style>
</head>
<body dir="rtl">
    <h1>تفاصيل الطلب رقم: {{ $serviceRequest->id }}</h1>
    <p><strong>نوع الخدمة:</strong> {{ $serviceRequest->serviceType->service_name_ar }}</p>
    <p><strong>الحالة:</strong> {{ $serviceRequest->status }}</p>
    <p><strong>تاريخ الإنشاء:</strong> {{ $serviceRequest->created_at->format('Y-m-d') }}</p>
    <hr>
    <h2>المعلومات الأساسية</h2>
    <p><strong>عنوان الطلب:</strong> {{ $serviceRequest->request_title }}</p>
    <p><strong>تفاصيل الطلب:</strong> {{ $serviceRequest->request_description }}</p>
    @if ($serviceRequest->related_case_id)
        <p><strong>رقم القضية:</strong> {{ $serviceRequest->related_case_id }}</p>
    @endif
</body>
</html>
