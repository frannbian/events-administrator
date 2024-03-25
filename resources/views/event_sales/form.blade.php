<?php
$readOnly = request()->is('event_sales/' . $eventSale?->id);
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('layout.event_sale') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mb-8 pb-3">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">
                        @if ($readOnly)
                            {{ __('layout.event_sale_view') }}
                        @elseif($eventSale?->id)
                            {{ __('layout.event_sale_edit') }}
                        @else
                            {{ __('layout.event_sale_create') }}
                        @endif
                    </h2>
                </div>

                <form method="POST" action="{{ $eventSale?->id ? route('event_sales.update', $eventSale->id) : route('event_sales.store')}}" enctype="multipart/form-data">
                    <!-- Grid -->
                    @csrf
                    @if($eventSale?->id)
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif
                    <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">

                        <div class="sm:col-span-3">
                            <label for="event" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                                {{ __("form_fields.event_sales.labels.event") }}
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <div class="sm:flex">
                                <select @if($readOnly) readonly disabled @endif  name="event_id" value="{{ $eventSale?->quantity }}"  class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600">
                                    <option selected value="'">Seleccionar</option>
                                        @foreach($events as $event)
                                            <option value="{{ $event->id }}" @if($event->id === $eventSale?->event_id) selected @endif>{{ $event->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                            @error('event_id')
                                <p class="pl-1 text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                                {{ __("form_fields.event_sales.labels.quantity") }}
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <input id="quantity" name="quantity" @if($readOnly) readonly disabled @endif  value="{{ $eventSale?->quantity }}" type="number" min="0" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" placeholder="0">
                            @error('quantity')
                                <p class="pl-1 text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- End Col -->

                        <!-- End Col -->
                        <div class="sm:col-span-3">
                            <label for="name" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                                {{ __("form_fields.event_sales.labels.name") }}
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <div class="sm:flex">
                                <input id="name" name="name" type="text" @if($readOnly) readonly disabled @endif value="{{ $eventSale?->individual?->name }}" class="@error('name') is-invalid @enderror py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" placeholder="Nombre">
                            </div>
                            @error('name')
                                <p class="pl-1 text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <label for="lastname" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                                {{ __("form_fields.event_sales.labels.lastname") }}
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <div class="sm:flex">
                                <input id="lastname" name="lastname" type="text" @if($readOnly) readonly disabled @endif value="{{ $eventSale?->individual?->lastname }}" class="@error('lastname') is-invalid @enderror py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" placeholder="Apellido">
                            </div>
                            @error('lastname')
                                <p class="pl-1 text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <label for="email" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                                {{ __("form_fields.event_sales.labels.email") }}
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <div class="sm:flex">
                                <input id="email" name="email" type="text" @if($readOnly) readonly disabled @endif  value="{{ $eventSale?->individual?->email }}" class="@error('email') is-invalid @enderror py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" placeholder="Email">
                            </div>
                            @error('email')
                                <p class="pl-1 text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- End Col -->

                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <label for="payment_proof" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                                {{ __("form_fields.event_sales.labels.payment_proof") }}
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <div class="sm:flex">
                                <!-- <input type="file" name="payment_proof" @if($readOnly) readonly disabled @endif class="@error('payment_proof') is-invalid @enderror block w-full text-sm text-gray-500
                                "> -->
                                <div class="mb-3">
                                    <input name="payment_proof" class="@error('payment_proof') is-invalid @enderror block w-full text-sm text-gray-500
                                        file:me-4 file:py-2 file:px-4
                                        file:rounded-lg file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-blue-600 file:text-white
                                        hover:file:bg-blue-700
                                        dark:file:bg-blue-500
                                        dark:hover:file:bg-blue-400" id="formFileLg" type="file">
                                </div>
                            </div>
                            @error('payment_proof')
                                <p class="pl-1 text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Grid -->
                    @if (!$readOnly)
                        <div class="mt-5 flex justify-end gap-x-2 pt-2">
                            <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                {{ __("layout.save_button") }}
                            </button>
                            <a href="{{ route('event_sales.index') }}">
                                <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                    {{ __("layout.cancel_button") }}
                                </button>
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
