
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
        x-data="accuweather"
        x-init="init">
        
    <div class="p-6">
        <template x-if="error">
            <div class="text-red-500" x-text="error"></div>
        </template>
        
        <template x-if="!error && !weather">
            <div class="text-gray-500">Loading weather...</div>
        </template>

        <template x-if="weather">
            <div class="flex items-center space-x-4">
                <img :src="'https://developer.accuweather.com/sites/default/files/' + weather.WeatherIcon.toString().padStart(2, '0') + '-s.png'"
                        class="w-16"
                        :alt="weather.WeatherText">
                <div>
                    <div class="text-2xl font-bold">
                        <span x-text="weather.Temperature.Metric.Value"></span>°C
                    </div>
                    <div class="text-gray-600" x-text="weather.WeatherText"></div>
                </div>
            </div>
        </template>
    </div>
</div>