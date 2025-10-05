<div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-8 bg-white p-8 rounded-2xl shadow-custom border border-gray-100">
            <!-- Header Section -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold grey-dark-text mb-2">طلبات الخدمة</h2>
                    <p class="text-lg grey-medium-text">إدارة ومتابعة طلبات الخدمات القضائية</p>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-gold-light border-2 gold-border rounded-xl p-4 text-center">
                    <div class="text-2xl font-bold gold-text mb-1">{{ $totalRequests ?? 0 }}</div>
                    <div class="text-sm grey-medium-text">إجمالي الطلبات</div>
                </div>
                <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-4 text-center">
                    <div class="text-2xl font-bold text-blue-600 mb-1">{{ $pendingRequests ?? 0 }}</div>
                    <div class="text-sm text-blue-600">طلبات قيد الانتظار</div>
                </div>
                <div class="bg-orange-50 border-2 border-orange-200 rounded-xl p-4 text-center">
                    <div class="text-2xl font-bold text-orange-600 mb-1">{{ $urgentRequests ?? 0 }}</div>
                    <div class="text-sm text-orange-600">طلبات عاجلة</div>
                </div>
                <div class="bg-green-50 border-2 border-green-200 rounded-xl p-4 text-center">
                    <div class="text-2xl font-bold text-green-600 mb-1">{{ $completedRequests ?? 0 }}</div>
                    <div class="text-sm text-green-600">طلبات مكتملة</div>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="my-6 flex flex-col lg:flex-row gap-4">
                <!-- Left Filters -->
                <div class="flex flex-col sm:flex-row gap-4 flex-1">
                    <div class="relative flex-1">
                        <select wire:model.lazy="is_urgent"
                            class="w-full appearance-none h-12 rounded-xl border border-gray-300 bg-white text-gray-700 py-2 px-4 pr-10 leading-tight focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300">
                            <option value="">جميع الطلبات</option>
                            <option value="true">طلبات عاجلة</option>
                            <option value="false">طلبات عادية</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center px-2 text-gray-700">
                            <i class="fas fa-filter"></i>
                        </div>
                    </div>

                    <div class="relative flex-1">
                        <select wire:model.lazy="department_id"
                            class="w-full appearance-none h-12 rounded-xl border border-gray-300 bg-white text-gray-700 py-2 px-4 pr-10 leading-tight focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300">
                            <option value="">جميع الدوائر</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->department_name_ar }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center px-2 text-gray-700">
                            <i class="fas fa-building"></i>
                        </div>
                    </div>

                    <div class="relative flex-1">
                        <select wire:model.lazy="status"
                            class="w-full appearance-none h-12 rounded-xl border border-gray-300 bg-white text-gray-700 py-2 px-4 pr-10 leading-tight focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300">
                            <option value="">جميع الحالات</option>
                            <option value="pending">قيد الانتظار</option>
                            <option value="in_progress">قيد المعالجة</option>
                            <option value="approved">مقبول</option>
                            <option value="completed">مكتمل</option>
                            <option value="rejected">مرفوض</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center px-2 text-gray-700">
                            <i class="fas fa-tasks"></i>
                        </div>
                    </div>
                </div>

                <!-- Search Box -->
                <div class="relative flex-1 lg:max-w-md">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input wire:model.lazy="search" placeholder="بحث في الطلبات..."
                        class="w-full h-12 rounded-xl border border-gray-300 bg-white text-gray-700 py-2 px-4 pr-10 leading-tight focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300 text-right" />
                </div>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto rounded-2xl shadow-custom border border-gray-100">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gradient-to-r from-[#2D3748] to-[#4A5568]">
                            <th
                                class="px-6 py-4 border-b-2 border-[#4A5568] text-right text-sm font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center justify-end">
                                    رقم الطلب
                                    <i class="fas fa-sort ml-2 text-gold-primary"></i>
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 border-b-2 border-[#4A5568] text-right text-sm font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center justify-end">
                                    مقدم الطلب
                                    <i class="fas fa-sort ml-2 text-gold-primary"></i>
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 border-b-2 border-[#4A5568] text-right text-sm font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center justify-end">
                                    نوع الخدمة
                                    <i class="fas fa-sort ml-2 text-gold-primary"></i>
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 border-b-2 border-[#4A5568] text-right text-sm font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center justify-end">
                                    رقم القضية
                                    <i class="fas fa-sort ml-2 text-gold-primary"></i>
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 border-b-2 border-[#4A5568] text-right text-sm font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center justify-end">
                                    الحالة
                                    <i class="fas fa-sort ml-2 text-gold-primary"></i>
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 border-b-2 border-[#4A5568] text-right text-sm font-bold text-white uppercase tracking-wider">
                                <div class="flex items-center justify-end">
                                    تاريخ الإنتهاء
                                    <i class="fas fa-sort ml-2 text-gold-primary"></i>
                                </div>
                            </th>
                            <th
                                class="px-6 py-4 border-b-2 border-[#4A5568] text-right text-sm font-bold text-white uppercase tracking-wider">
                                الإجراءات
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($serviceRequests as $serviceRequest)
                            <tr
                                class="hover:bg-gold-light transition-all duration-300 cursor-pointer border-b border-gray-200">
                                <td class="px-6 py-4 bg-white text-sm">
                                    <div class="flex items-center justify-end">
                                        <span
                                            class="text-gray-900 font-semibold">{{ $serviceRequest->request_number }}</span>
                                        @if($serviceRequest->is_urgent_service)
                                            <span class="mr-2 bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">
                                                <i class="fas fa-exclamation-triangle ml-1"></i>
                                                عاجل
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 bg-white text-sm">
                                    <div class="flex items-center justify-end">
                                        <div class="ml-3 text-right">
                                            <p class="text-gray-900 font-medium whitespace-no-wrap">
                                                {{ $serviceRequest->first_name }} {{ $serviceRequest->last_name }}
                                            </p>
                                            <p class="text-gray-500 text-xs">
                                                {{ $serviceRequest->role_name }}
                                            </p>
                                        </div>
                                        <div
                                            class="w-8 h-8 bg-gold-primary rounded-full flex items-center justify-center text-white text-xs font-bold">
                                            {{ substr($serviceRequest->first_name, 0, 1) }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 bg-white text-sm">
                                    <div class="flex items-center justify-end">
                                        <span
                                            class="text-gray-900">{{ $serviceRequest->service_name_ar ?? $serviceRequest->service_name_en }}</span>
                                        <div class="ml-2 w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-file-contract text-blue-600 text-sm"></i>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 bg-white text-sm">
                                    <p class="text-gray-900 text-right">
                                        {{ $serviceRequest->case_number ?: 'غير محدد' }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 bg-white text-sm">
                                    @php
                                        $statusColors = [
                                            'pending' => ['bg-yellow-100', 'text-yellow-800', 'قيد الانتظار'],
                                            'approved' => ['bg-green-100', 'text-green-800', 'مقبول'],
                                            'rejected' => ['bg-red-100', 'text-red-800', 'مرفوض'],
                                            'in_progress' => ['bg-blue-100', 'text-blue-800', 'قيد المعالجة'],
                                            'completed' => ['bg-green-100', 'text-green-800', 'مكتمل']
                                        ];
                                        $statusConfig = $statusColors[$serviceRequest->status] ?? ['bg-gray-100', 'text-gray-800', $serviceRequest->status];
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusConfig[0] }} {{ $statusConfig[1] }}">
                                        <span class="w-2 h-2 bg-current rounded-full ml-1"></span>
                                        {{ $statusConfig[2] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 bg-white text-sm">
                                    <div class="text-right">
                                        <p class="text-gray-900 font-medium">
                                            {{ \Carbon\Carbon::now()->addDays($serviceRequest->rest_days) }}
                                        </p>
                                        {{-- <p class="text-gray-500 text-xs">
                                            {{ \Carbon\Carbon::parse($serviceRequest->created_at)->format('h:i A') }}
                                        </p> --}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 bg-white text-sm">
                                    <div class="flex items-center justify-end space-x-2 space-x-reverse">
                                        <a href="{{ route('admin.service-request.details', base64_encode($serviceRequest->id)) }}"
                                            class="text-blue-600 hover:text-blue-900 transition-colors duration-300 flex items-center"
                                            wire:navigate
                                            title="عرض التفاصيل">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        {{-- <button
                                            class="text-green-600 hover:text-green-900 transition-colors duration-300 flex items-center"
                                            title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </button> --}}
                                        <button
                                            class="text-red-600 hover:text-red-900 transition-colors duration-300 flex items-center"
                                            title="حذف">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if($serviceRequests->isEmpty())
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-inbox text-gray-400 text-2xl"></i>
                                        </div>
                                        <h3 class="text-lg font-medium grey-dark-text mb-2">لا توجد طلبات</h3>
                                        <p class="text-gray-500">لم يتم العثور على أي طلبات خدمات تطابق معايير البحث</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <!-- Enhanced Pagination -->
                @if($serviceRequests->isNotEmpty())
                    <div class="px-6 py-4 bg-white border-t border-gray-200">
                        <div class="flex flex-col lg:flex-row items-center justify-between space-y-4 lg:space-y-0">
                            <div class="text-sm text-gray-700">
                                عرض
                                <span class="font-bold gold-text">{{ $serviceRequests->firstItem() }}</span>
                                إلى
                                <span class="font-bold gold-text">{{ $serviceRequests->lastItem() }}</span>
                                من
                                <span class="font-bold grey-dark-text">{{ $serviceRequests->total() }}</span>
                                طلب
                            </div>

                            <div class="flex items-center space-x-2 space-x-reverse">
                                <!-- Custom Pagination Links -->
                                <nav class="flex items-center space-x-2 space-x-reverse">
                                    <!-- First Page -->
                                    @if($serviceRequests->onFirstPage())
                                        <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                            <i class="fas fa-angle-double-right"></i>
                                        </span>
                                    @else
                                        <a href="{{ $serviceRequests->url(1) }}" wire:navigate
                                            class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gold-light hover:border-gold-primary transition-all duration-300">
                                            <i class="fas fa-angle-double-right"></i>
                                        </a>
                                    @endif

                                    <!-- Previous Page -->
                                    @if($serviceRequests->onFirstPage())
                                        <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                            <i class="fas fa-angle-right"></i>
                                        </span>
                                    @else
                                        <a href="{{ $serviceRequests->previousPageUrl() }}" wire:navigate
                                            class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gold-light hover:border-gold-primary transition-all duration-300">
                                            <i class="fas fa-angle-right"></i>
                                        </a>
                                    @endif

                                    <!-- Page Numbers -->
                                    @foreach($serviceRequests->getUrlRange(max(1, $serviceRequests->currentPage() - 2), min($serviceRequests->lastPage(), $serviceRequests->currentPage() + 2)) as $page => $url)
                                        @if($page == $serviceRequests->currentPage())
                                            <span class="px-4 py-2 gold-bg text-white rounded-lg font-bold shadow-lg">
                                                {{ $page }}
                                            </span>
                                        @else
                                            <a href="{{ $url }}" wire:navigate
                                                class="px-4 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gold-light hover:border-gold-primary transition-all duration-300">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    @endforeach

                                    <!-- Next Page -->
                                    @if($serviceRequests->hasMorePages())
                                        <a href="{{ $serviceRequests->nextPageUrl() }}" wire:navigate
                                            class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gold-light hover:border-gold-primary transition-all duration-300">
                                            <i class="fas fa-angle-left"></i>
                                        </a>
                                    @else
                                        <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                            <i class="fas fa-angle-left"></i>
                                        </span>
                                    @endif

                                    <!-- Last Page -->
                                    @if($serviceRequests->hasMorePages())
                                        <a href="{{ $serviceRequests->url($serviceRequests->lastPage()) }}" wire:navigate
                                            class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gold-light hover:border-gold-primary transition-all duration-300">
                                            <i class="fas fa-angle-double-left"></i>
                                        </a>
                                    @else
                                        <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                            <i class="fas fa-angle-double-left"></i>
                                        </span>
                                    @endif
                                </nav>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .page-item.active .page-link {
            background-color: #D4AF37;
            border-color: #D4AF37;
            color: white;
        }

        .page-link {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-right: -1px;
            line-height: 1.25;
            color: #4A5568;
            background-color: #fff;
            border: 1px solid #E2E8F0;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            z-index: 2;
            color: #2D3748;
            text-decoration: none;
            background-color: #F7EFD8;
            border-color: #D4AF37;
        }
    </style>
</div>