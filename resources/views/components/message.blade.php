@if(Session::has('message') || Session::has('success'))
    @if(Session::has('success'))
        <div class="z-50 absolute inset-x-0 top-50 shadow-xl bg-white mx-auto rounded-lg rounded-t-none">
            <div class="rounded-md bg-green-50 p-4">
                <div class="flex justify-center">
                <div class="mt-20 flex-shrink-0">
                    <svg class="h-5 w-5 top-50 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3 mt-20">
                    <h3 class="text-sm font-medium text-green-800">
                    Succès
                    </h3>
                    <div class="mt-2 text-sm text-green-700">
                    <p>
                        {{ Session::get('success') }}
                    </p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    @else
        <div class="z-50 absolute inset-x-0 top-50 shadow-xl bg-white mx-auto rounded-lg rounded-t-none">
            <div class="rounded-md bg-red-50 p-4">
                <div class="flex justify-center">
                <div class="mt-20 flex-shrink-0">
                    <svg class="h-5 w-5 top-50 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="mt-20 ml-3">
                    <h3 class="text-sm font-medium text-red-800">
                    Erreur !
                    </h3>
                    <div class="mt-2 text-sm text-red-700">
                    <ul role="list" class="list-disc pl-5 space-y-1">
                        <li>
                            {{ Session::get('error') }}
                        </li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
    @endif
@endif

