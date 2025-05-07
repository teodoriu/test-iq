export default () => ({
    weather: null,
    error: null,
    async getWeather(lat, lon) {
        try {

            // Get API key from meta tag in HTML
            const apiKey = document.querySelector('meta[name="accuweather-key"]').content;
            
            // First API call: Get location key based on coordinates
            const locResponse = await fetch(`https://dataservice.accuweather.com/locations/v1/cities/geoposition/search?apikey=${apiKey}&q=${lat},${lon}`);
            const locData = await locResponse.json();
            
            // Second API call: Get current weather conditions using location key
            const weatherResponse = await fetch(`https://dataservice.accuweather.com/currentconditions/v1/${locData.Key}?apikey=${apiKey}`);
            const weatherData = await weatherResponse.json();
            
            // Update component state with weather data
            this.weather = weatherData[0];
            this.error = null;
        } catch (e) {
            this.error = 'Could not fetch weather data';
            this.weather = null;
        }
    },

    // Initialize component
    init() {
        // Check if browser supports geolocation
        if (navigator.geolocation) {
            // Request user's location
            navigator.geolocation.getCurrentPosition(
                // Success callback: fetch weather for obtained coordinates
                position => this.getWeather(position.coords.latitude, position.coords.longitude),
                // Error callback: update error state
                () => this.error = 'Could not get location'
            );
        }
    }
})