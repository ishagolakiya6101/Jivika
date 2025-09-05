<template>
    <div>
        <GoogleMap :api-key='apiKey' style="width: 100%; height: 500px" :center="center" :zoom="zoom">
            <Marker :options="{ position: center }" />
        </GoogleMap>
    </div>
</template>

<script>
import { GoogleMap, Marker } from "vue3-google-map";

export default {
components: { GoogleMap, Marker },
    setup() {
    const center = { lat: 21.170240, lng:72.831062 };
    return { center };
  },
  data() {
    return {
      map: null,
      apiKey: "AIzaSyAZKTvNG-w-wdxCnB9x-sOGboQMYWXt7B4",
      zoom:12
    };
  }
};
</script>

<style scoped>
#map {
    height: 400px;
    width: 100%;
}
</style>
