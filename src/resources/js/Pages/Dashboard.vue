<template>
    <q-layout view="hHh lpR fFf" style="background: #0d0f14;">

        <header-component />

        <q-page-container>
            <q-page style="background: #0d0f14; min-height: 100vh;" class="q-pa-lg">

                <!-- Search -->
                <q-input v-model="search" placeholder="Search coin..." dense dark outlined rounded class="q-mb-md"
                    style="max-width: 400px; background: #1a1d26;">
                    <template #prepend>
                        <q-icon name="search" color="grey-6" />
                    </template>
                </q-input>

                <!-- Table -->
                <q-card dark flat
                    style="background: #1a1d26; border: 1px solid rgba(255,255,255,0.06); border-radius: 16px;">
                    <q-list dark separator>

                        <!-- Header Row -->
                        <q-item style="opacity: 0.5;">
                            <q-item-section style="max-width: 40px;">
                                <q-item-label caption class="text-grey-5 text-uppercase">#</q-item-label>
                            </q-item-section>
                            <q-item-section>
                                <q-item-label caption class="text-grey-5 text-uppercase">Coin</q-item-label>
                            </q-item-section>
                            <q-item-section side>
                                <q-item-label caption class="text-grey-5 text-uppercase">Price</q-item-label>
                            </q-item-section>
                            <q-item-section side style="min-width: 100px;">
                                <q-item-label caption class="text-grey-5 text-uppercase">24h</q-item-label>
                            </q-item-section>
                        </q-item>

                        <!-- Coin Rows -->
                        <q-item v-for="coin in filteredCoins" :key="coin.id" clickable v-ripple dark
                            @click="$inertia.visit(`/coins/${coin.coin_id}`)" style="transition: background 0.2s;">
                            <!-- Rank -->
                            <q-item-section style="max-width: 40px;">
                                <q-item-label class="text-grey-5 text-weight-medium">{{ coin.market_cap_rank
                                    }}</q-item-label>
                            </q-item-section>

                            <!-- Logo + Name -->
                            <q-item-section avatar>
                                <q-avatar size="36px">
                                    <img :src="coin.image" :alt="coin.name" />
                                </q-avatar>
                            </q-item-section>
                            <q-item-section>
                                <q-item-label class="text-white text-weight-semibold">{{ coin.name }}</q-item-label>
                                <q-item-label caption class="text-grey-6 text-uppercase">{{ coin.symbol
                                    }}</q-item-label>
                            </q-item-section>

                            <!-- Price -->
                            <q-item-section side>
                                <q-item-label class="text-white text-weight-semibold">{{ formatPrice(coin.current_price)
                                    }}</q-item-label>
                            </q-item-section>

                            <!-- 24h Change -->
                            <q-item-section side style="min-width: 90px;">
                                <q-badge :color="coin.price_change_percentage_24h >= 0 ? 'green-9' : 'red-9'"
                                    :text-color="coin.price_change_percentage_24h >= 0 ? 'green-4' : 'red-4'"
                                    class="q-pa-xs" style="border-radius: 8px; font-size: 13px;">
                                    <q-icon
                                        :name="coin.price_change_percentage_24h >= 0 ? 'arrow_drop_up' : 'arrow_drop_down'"
                                        size="16px" />
                                    {{ formatPercent(coin.price_change_percentage_24h) }}
                                </q-badge>
                            </q-item-section>
                        </q-item>

                        <!-- Empty state -->
                        <q-item v-if="filteredCoins.length === 0">
                            <q-item-section class="text-center q-py-xl">
                                <q-icon name="search_off" size="48px" color="grey-8" class="q-mb-sm" />
                                <q-item-label class="text-grey-6">No coins found for "{{ search }}"</q-item-label>
                            </q-item-section>
                        </q-item>

                    </q-list>
                </q-card>

                <!-- Footer -->
                <div class="text-center text-caption text-grey-8 q-mt-md">
                    Data sourced from CoinGecko · Last updated {{ lastUpdated }}
                </div>

            </q-page>
        </q-page-container>

    </q-layout>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import HeaderComponent from '../Components/HeaderComponent.vue'

const props = defineProps({
    coins: {
        type: Array,
        default: () => []
    }
})

// Local mutable copy — props are read-only and can't be updated by Echo directly
const coins = ref([...props.coins])

const search = ref('')

const filteredCoins = computed(() => {
    if (!search.value) return coins.value
    const q = search.value.toLowerCase()
    return coins.value.filter(c =>
        c.name.toLowerCase().includes(q) ||
        c.symbol.toLowerCase().includes(q)
    )
})

const lastUpdated = computed(() => {
    if (!coins.value.length) return '—'
    return new Date(coins.value[0].last_updated).toLocaleTimeString()
})

function formatPrice(value) {
    if (value === null || value === undefined) return '—'
    const num = parseFloat(value)
    if (num < 0.01) return `$${num.toFixed(6)}`
    if (num < 1) return `$${num.toFixed(4)}`
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        maximumFractionDigits: 2,
    }).format(num)
}

function formatPercent(value) {
    if (value === null || value === undefined) return '—'
    return `${Math.abs(parseFloat(value)).toFixed(2)}%`
}

onMounted(() => {
    window.Echo.channel('crypto-prices')
        .listen('CryptoPriceUpdated', (e) => {
            const index = coins.value.findIndex(c => c.id === e.coin.id)
            if (index !== -1) {
                coins.value[index] = { ...coins.value[index], ...e.coin }
            }
        })
})

onUnmounted(() => {
    window.Echo.leaveChannel('crypto-prices')
})
</script>
