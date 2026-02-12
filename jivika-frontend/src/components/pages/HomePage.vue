<template>
  <div>
    <Header />

    <!-- PAGE TITLE -->
    <div
      class="page-title-section"
      :style="{ backgroundImage: `url(${backgroundImage})` }"
    ></div>

    <div class="mt-20 text-4xl font-medium text-zinc-900">
      How it work
    </div>

    <div class="mt-3 text-lg text-neutral-800">
      Learn from Industry Experts and Enhance Your Skills.
    </div>

    <!-- CUSTOMER / FREELANCER TAB BUTTONS -->
    <div class="flex gap-5 justify-center mt-10 text-lg text-center">
      <button
        :class="activeTab === 'customer' ? activeClass : inactiveClass"
        @click="activeTab = 'customer'"
      >
        Customer
      </button>

      <button
        :class="activeTab === 'freelancer' ? activeClass : inactiveClass"
        @click="activeTab = 'freelancer'"
      >
        Freelancer
      </button>
    </div>

    <!-- CATEGORY SECTION -->
    <div class="px-16 pt-8 pb-12 mt-12 bg-white">
      <div class="text-center text-4xl font-medium text-zinc-900">
        Category
      </div>

      <div class="text-center mt-3">
        Learn from Industry Experts and Enhance Your Skills.
      </div>

      <div class="row justify-center mt-10">
        <div
          class="col-2 m-2 px-6 py-9 bg-violet-50 rounded-2xl text-center"
          v-for="(item, index) in categories"
          :key="index"
        >
          <img :src="item.image" class="w-[90px] mx-auto" />
          <div class="mt-3">{{ item.name }}</div>
        </div>
      </div>
    </div>

    <!-- SERVICES SECTION -->
    <div class="px-10 mt-12 bg-weather-secondary pb-12">
      <div class="text-4xl font-medium mt-5 text-center">Service</div>

      <div class="text-lg text-center mt-3">
        Learn from Industry Experts and Enhance Your Skills.
      </div>

      <div class="flex flex-wrap justify-center gap-5 mt-10">
        <div
          class="w-[30%] bg-white rounded-lg border p-4"
          v-for="(item, index) in services"
          :key="index"
        >
          <img :src="item.image" class="w-full aspect-[1.56]" />

          <div class="mt-3 text-lg font-semibold">
            {{ item.name }}
          </div>

          <div class="mt-2 text-neutral-600">
            {{ item.description }}
          </div>

          <div class="flex justify-between mt-3">
            <div>
              <span class="text-lg font-bold text-orange-500">
                ₹ {{ item.offer_price }}
              </span>
              <strike class="ml-2">₹ {{ item.price }}</strike>
            </div>

            <div
              class="px-4 py-2 bg-blue-100 text-blue-600 rounded-lg cursor-pointer"
            >
              Book Now
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- TESTIMONIAL SECTION -->
    <div class="px-16 pt-8 pb-12 mt-12 bg-white">
      <div class="text-4xl font-medium text-center">Testimonial</div>

      <div class="text-lg text-center mt-3">
        Learn from Industry Experts and Enhance Your Skills.
      </div>

      <div class="flex gap-5 justify-center mt-12 flex-wrap">
        <div
          class="w-[30%] bg-neutral-100 rounded-3xl p-7 text-center"
          v-for="(item, index) in testimonials"
          :key="index"
        >
          <img
            :src="item.image"
            class="w-24 h-24 mx-auto rounded-full"
          />

          <div class="mt-3 text-2xl font-semibold">
            {{ item.name }}
          </div>

          <div class="text-zinc-500 font-bold mt-2">
            {{ item.title }}
          </div>

          <div class="mt-4 text-slate-500">
            {{ item.words }}
          </div>
        </div>
      </div>
    </div>

    <Footer />
  </div>
</template>

<script>
import Header from "@/components/partials/HeaderSection.vue";
import Footer from "@/components/partials/FooterSection.vue";

export default {
  components: {
    Header,
    Footer,
  },

  data() {
    return {
      activeTab: "customer",

      activeClass:
        "px-9 py-6 font-bold text-white bg-weather-primary rounded-[40px]",

      inactiveClass:
        "px-9 py-6 text-weather-primary bg-white border border-zinc-300 rounded-[36px]",

      backgroundImage:
        "https://cdn.builder.io/api/v1/image/assets/TEMP/2782abe7edcf3748866ad2222e8f2c67e9d7f1fe66189de1ce41acf4195e66cb?apiKey=023108a9c99043f18acff792c7e6bb89",

      // STATIC CATEGORY DATA
      categories: [
        {
          name: "Photography",
          image:
            "https://cdn.pixabay.com/photo/2016/11/29/05/45/adult-1868750_1280.jpg",
        },
        {
          name: "Makeup Artist",
          image:
            "https://cdn.pixabay.com/photo/2017/08/01/08/29/people-2563491_1280.jpg",
        },
        {
          name: "Fashion Stylist",
          image:
            "https://cdn.pixabay.com/photo/2017/06/26/02/47/man-2442565_1280.jpg",
        },
        {
          name: "Hair Stylist",
          image:
            "https://cdn.pixabay.com/photo/2016/03/27/07/08/hairdresser-1283820_1280.jpg",
        },
        {
          name: "Event Planner",
          image:
            "https://cdn.pixabay.com/photo/2017/08/06/11/30/wedding-2595862_1280.jpg",
        },
      ],

      // STATIC SERVICES DATA
      services: [
        {
          name: "Wedding Photography",
          image:
            "https://cdn.pixabay.com/photo/2016/11/29/05/45/adult-1868750_1280.jpg",
          description:
            "Professional wedding photography service with premium quality.",
          price: 500,
          offer_price: 350,
        },
        {
          name: "Fashion Shoot",
          image:
            "https://cdn.pixabay.com/photo/2017/06/26/02/47/man-2442565_1280.jpg",
          description:
            "Creative fashion photography for models and brands.",
          price: 400,
          offer_price: 280,
        },
        {
          name: "Makeup Service",
          image:
            "https://cdn.pixabay.com/photo/2017/08/01/08/29/people-2563491_1280.jpg",
          description: "Professional makeup for all occasions.",
          price: 200,
          offer_price: 150,
        },
      ],

      // STATIC TESTIMONIAL DATA
      testimonials: [
        {
          name: "Priya Sharma",
          title: "Happy Client",
          words:
            "Amazing service and very professional freelancer. Highly recommended!",
          image: "https://randomuser.me/api/portraits/women/1.jpg",
        },
        {
          name: "Rahul Patel",
          title: "Customer",
          words:
            "Booking process was smooth and service quality was excellent.",
          image: "https://randomuser.me/api/portraits/men/2.jpg",
        },
        {
          name: "Neha Verma",
          title: "Fashion Influencer",
          words:
            "Great experience working with talented professionals.",
          image: "https://randomuser.me/api/portraits/women/3.jpg",
        },
      ],
    };
  },
};
</script>
