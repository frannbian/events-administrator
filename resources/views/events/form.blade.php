<?php
$readOnly = request()->is('events/' . $event?->id);
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('layout.events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mb-8 pb-3">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">
                        @if ($readOnly)
                            {{ __('layout.event_view') }}
                        @elseif($event?->id)
                            {{ __('layout.event_edit') }}
                        @else
                            {{ __('layout.event_create') }}
                        @endif
                    </h2>
                </div>

                <form method="POST" action="{{ $event?->id ? route('events.update', $event->id) : route('events.store')}}">
                    <!-- Grid -->
                    @csrf
                    @if($event?->id)
                        @method('PUT')
                    @endif
                    <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">

                        <div class="sm:col-span-3">
                            <label for="name" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                                {{ __("form_fields.events.labels.name") }}
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <div class="sm:flex">
                                <input id="name" name="name" type="text" @if($readOnly) readonly disabled @endif value="{{ $event?->name }}" value="{{ $event?->name }}" class="@error('name') is-invalid @enderror py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" placeholder="Nombre">
                            </div>
                            @error('name')
                                <p class="pl-1 text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                            <label for="date" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                                {{ __("form_fields.events.labels.date") }}
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <div class="sm:flex">
                                <input id="date" name="date" type="date" @if($readOnly) readonly disabled @endif value="{{ $event?->id ? date('Y-m-d',strtotime($event?->date)) : '' }}" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" placeholder="Fecha">
                            </div>
                            @error('date')
                                <p class="pl-1 text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-3">
                        <label for="" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                            {{ __("form_fields.events.labels.available_tickets") }}
                        </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <input id="available_tickets" name="available_tickets" @if($readOnly) readonly disabled @endif  value="{{ $event?->available_tickets }}" type="number" min="0" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" placeholder="0">
                            @error('available_tickets')
                                <p class="pl-1 text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- End Col -->


                        <div class="sm:col-span-3">
                            <label for="description" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-gray-200">
                                {{ __("form_fields.events.labels.description") }}
                            </label>
                        </div>
                        <!-- End Col -->

                        <div class="sm:col-span-9">
                            <textarea id="description" name="description"  @if($readOnly) readonly disabled @endif class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" rows="6" placeholder="Descripción...">{{ $event?->description }}</textarea>
                            @error('description')
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
                            <a href="{{ route('events.index') }}">
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
