<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pembayaran Invoice #{{ $subscription->invoice_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-center mb-6">
                    <p class="text-sm text-gray-500">Total Pembayaran</p>
                    <h3 class="text-3xl font-extrabold text-indigo-600">
                        Rp {{ number_format($subscription->amount, 0, ',', '.') }}
                    </h3>
                </div>

                <div class="border-t border-b border-gray-200 py-4 mb-6">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Paket:</span>
                        <span class="font-semibold">{{ $subscription->plan->name }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Metode:</span>
                        <span class="font-semibold">{{ $subscription->payment_method }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status:</span>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            {{ strtoupper($subscription->status) }}
                        </span>
                    </div>
                </div>

                <form action="{{ route('subscriptions.pay', $subscription) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded transition duration-150">
                        Simulasi Bayar Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>