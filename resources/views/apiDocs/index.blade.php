<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Api docs</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class="w-full px-10 py-5">
        <div class="lg:flex lg:items-center lg:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                    {{ $data['title'] }}
                </h2>
                <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                    <div class="mt-2 flex items-center text-sm text-gray-500">

                        {{ $data['description'] }}
                    </div>

                </div>
            </div>

        </div>

    </div>
    <div class="w-full px-10 py-5">
        @foreach ($groups as $group)
            {{--   <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">

            </h2> --}}
            <div class="lg:flex lg:items-center lg:justify-between">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                        {{ $group['groupName'] }}
                    </h2>
                    <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                        <div class="mt-2 flex items-center text-sm text-gray-500">

                            {{ $group['description'] }}
                        </div>

                    </div>
                </div>

            </div>
            @foreach ($group['routes'] as $route)
                <ul role="list" class="divide-y divide-gray-100">
                    <li class="flex justify-between gap-x-6 py-5">
                        <div class="flex min-w-0 gap-x-4">

                            <div class="min-w-0 flex-auto">
                                <p class="text-sm font-semibold leading-6 text-gray-900">
                                    <span class="mx-2">
                                        {{ $route['path'] }}
                                    </span>
                                    @switch($route["method"])
                                        @case('GET')
                                            <span
                                                class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{ $route['method'] }}</span>
                                        @break

                                        @case('POST')
                                            <span
                                                class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">{{ $route['method'] }}</span>
                                        @break

                                        @case('PUT')
                                            <span
                                                class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">{{ $route['method'] }}</span>
                                        @break

                                        @case('DELETE')
                                            <span
                                                class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">{{ $route['method'] }}</span>
                                        @break

                                        @default
                                            <span
                                                class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">{{ $route['method'] }}</span>
                                    @endswitch


                                </p>

                                <p class="mt-1 font-bold text-xs leading-5 text-black mx-2">
                                    {{ $route['description'] }}
                                </p>
                                <div class="my-2">
                                    @if (!is_null($route['parameters']))
                                        <p class="mt-1 font-bold text-md leading-5 text-black mx-2">
                                            Parameters :
                                            @foreach ($route['parameters'] as $parameterKey => $parameterValue)
                                                <div class="w-full mx-2">
                                                    <p>
                                                        {{ $parameterKey }} : {{ $parameterValue }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        </p>
                                    @endif
                                </div>
                                <div class="my-2">
                                    @if (!is_null($route['request']))
                                        <p class="mt-1 font-bold text-md leading-5 text-black mx-2">
                                            Request data example :
                                            @foreach ($route['request'] as $parameterKey => $parameterValue)
                                                <div class="w-full mx-2">
                                                    <p>
                                                        {{ $parameterKey }} : {{ $parameterValue }}
                                                    </p>
                                                </div>
                                            @endforeach
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </li>

                </ul>
            @endforeach
        @endforeach

    </div>
</body>

</html>
