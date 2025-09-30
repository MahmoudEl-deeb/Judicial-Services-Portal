<div>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">طلبات الخدمات</h2>
            </div>
            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">خطأ!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            <div class="my-2 flex sm:flex-row flex-col">
                <div class="flex flex-row mb-1 sm:mb-0">
                    <div class="relative">
                        <select
                            class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option>5</option>
                            <option>10</option>
                            <option>20</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                    <div class="relative">
                        <select
                            class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                            <option>الكل</option>
                            <option>نشط</option>
                            <option>غير نشط</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="block relative">
                    <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                            <path
                                d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387-1.414 1.414-5.387-5.387A8 8 0 012 10z">
                            </path>
                        </svg>
                    </span>
                    <input placeholder="بحث"
                        class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                @foreach ($serviceRequests as $serviceRequest)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $serviceRequest->service_type_name }}</h3>
                                <span class="px-2 py-1 text-xs font-semibold text-white bg-blue-500 rounded-full">{{ $serviceRequest->status_ar }}</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-2">رقم القضية: {{ $serviceRequest->case_number ?? 'غير متوفر' }}</p>
                            <p class="text-sm text-gray-600 mt-2">تاريخ الإنشاء: {{ \Carbon\Carbon::parse($serviceRequest->created_at)->toFormattedDateString() }}</p>
                            <p class="text-sm text-gray-600 mt-2">حالة الدفع: {{ $serviceRequest->is_paid ? 'مدفوع' : 'غير مدفوع' }}</p>
                        </div>
                        <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-4">
                            @if (auth()->user()->hasRole('lawyer'))
                                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-edit mr-1"></i> تعديل
                                </a>
                            @elseif(auth()->user()->hasRole('litigant'))
                                <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-900">
                                    <i class="fas fa-eye mr-1"></i> عرض
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">
                {{-- Pagination placeholder --}}
            </div>
        </div>
    </div>
</div>
