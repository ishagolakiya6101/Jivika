<template>
  <div>
    <Header />
    <div class="page-title-section" :style="{ backgroundImage: `url(${backgroundImage})` }">
      <div div class="overlay"></div>
      <div class="container">
        <h1 class="page-title">{{ pageTitle }}</h1>
      </div>
    </div>
    <div>
      <div
        class="flex flex-col items-start px-16 pt-6 text-lg font-bold leading-5 text-center whitespace-nowrap bg-stone-50 max-md:px-5">
        <div class="flex gap-5 justify-between ml-12 max-w-full w-[335px] max-md:ml-2.5">
          <button
            :class="{ 'grow justify-center px-9 py-6 text-white bg-weather-primary rounded-2xl max-md:px-5': activeTab === 'projects', 'flex-auto my-auto text-blue-600': activeTab !== 'projects' }"
            @click="activeTab = 'projects'">
            Projects
          </button>
          <button
            :class="{ 'grow justify-center px-9 py-6 text-white bg-weather-primary rounded-2xl max-md:px-5': activeTab === 'freelancer', 'flex-auto my-auto text-blue-600': activeTab !== 'freelancer' }"
            @click="activeTab = 'freelancer'">Freelancer</button>
        </div>
      </div>
      <div
        class="flex gap-2.5 p-5 justify-between px-3.5 py-2.5 text-3xl font-bold leading-10 text-blue-600 max-md:flex-wrap max-md:max-w-full">
        <div class="flex gap-5 justify-between max-md:flex-wrap max-md:max-w-full">
          <img loading="lazy"
            src="https://cdn.builder.io/api/v1/image/assets/TEMP/8038812727333a5dc2105562c455823a555a6cca684fb90129a77a00c66b7850?apiKey=023108a9c99043f18acff792c7e6bb89"
            class="my-auto w-6 aspect-square" />
          <div class="flex-auto max-md:max-w-full" v-if="activeTab == 'projects'">{{ totalService }} Services</div>
          <div class="flex-auto max-md:max-w-full" v-if="activeTab == 'freelancer'">{{ totalFreelancer }} Freelancers</div>
        </div>
        <div class="flex justify-end">

          <button class="flex gap-4 justify-between whitespace-nowrap" v-if="activeTabView != 'grid-view' && activeTab === 'projects'"
            @click="activeTabView = 'grid-view'">
            <img loading="lazy"
              src="https://cdn.builder.io/api/v1/image/assets/TEMP/838257cd1491859cb216e3f725f2b5b0a49cc7ef371db983d71114ec5cad51a4?apiKey=023108a9c99043f18acff792c7e6bb89"
              class="my-auto w-6 aspect-square" />
            <div class="grow">grid view</div>
          </button>
          <button class="flex gap-4 justify-between whitespace-nowrap" v-if="activeTabView != 'map-view' && activeTab === 'projects'"
            @click="activeTabView = 'map-view'">
            <img loading="lazy"
              src="https://cdn.builder.io/api/v1/image/assets/TEMP/838257cd1491859cb216e3f725f2b5b0a49cc7ef371db983d71114ec5cad51a4?apiKey=023108a9c99043f18acff792c7e6bb89"
              class="my-auto w-6 aspect-square" />
            <div class="grow">map view</div>
          </button>
          <button class="flex gap-4 text-3xl font-bold leading-10 text-blue-600 whitespace-nowrap"
            v-if="activeTabView != 'list-view' && activeTab === 'projects'" @click="activeTabView = 'list-view'">
            <img loading="lazy"
              src="https://cdn.builder.io/api/v1/image/assets/TEMP/838257cd1491859cb216e3f725f2b5b0a49cc7ef371db983d71114ec5cad51a4?apiKey=023108a9c99043f18acff792c7e6bb89"
              class="my-auto w-6 aspect-square" />
            <div class="grow">List view</div>
          </button>
        </div>
      </div>
      <div class="row px-5 container-fluid" v-if="activeTab === 'projects' && activeTabView === 'map-view'">
        <div class="col-6">
          <div class="service-filter">
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="ratingDropdown" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Rating
              </button>
              <div class="dropdown-menu" aria-labelledby="ratingDropdown">
                <a class="dropdown-item" href="#">5 stars</a>
                <a class="dropdown-item" href="#">4 stars</a>
                <a class="dropdown-item" href="#">3 stars</a>
                <!-- Add more rating options here -->
              </div>
            </div>
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="distanceDropdown"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Distance
              </button>
              <div class="dropdown-menu" aria-labelledby="distanceDropdown">
                <a class="dropdown-item" href="#">Less than 1 mile</a>
                <a class="dropdown-item" href="#">1 - 5 miles</a>
                <a class="dropdown-item" href="#">5 - 10 miles</a>
                <!-- Add more distance options here -->
              </div>
            </div>
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="priceRangeDropdown"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Price Range
              </button>
              <div class="dropdown-menu" aria-labelledby="priceRangeDropdown">
                <a class="dropdown-item" href="#">$</a>
                <a class="dropdown-item" href="#">$$</a>
                <a class="dropdown-item" href="#">$$$</a>
                <!-- Add more price range options here -->
              </div>
            </div>
          </div>
          <div class="service-list">
            <div class="card" v-for="(profile, index) in services" :key="index">
              <div class="card-header">
                <h1 class="title">{{ profile.name }}</h1>
              </div>
              <div class="card-content">
                <aside class="freelancer-info">
                  <div class="status-indicator"></div>
                  <p class="freelancer-count">{{ cleanHtml(profile.description) }} </p>
                </aside>
                <img loading="lazy"
                  src="https://cdn.builder.io/api/v1/image/assets/TEMP/8c190f8a173b785ac9cef3eb89508b6bb5e002025a52739fd2b9a737a0d8f83c?apiKey=eee0753079fd4b13bbc2e8bc70e7b768"
                  alt="Family photoshoot samples" class="photo-preview" />
              </div>
              <img loading="lazy" :src="profile.image" alt="Photographer profile picture" class="profile-picture" />
            </div>
          </div>
        </div>

        <div class="col-6">
          <GoogleMap />
        </div>
      </div>
      <div class="row px-5 container-fluid" v-if="activeTab === 'projects' && activeTabView === 'list-view'">
        <div
          className="px-10 py-3 w-full mt-2.5 mx-10 bg-white rounded-xl border-solid border-[3px] border-zinc-100 max-md:px-5 max-md:max-w-full text-wrap"
          v-for="(item, index) in displayedItems" :key="index">
          <div className="flex gap-5 max-md:flex-col max-md:gap-0">
            <div className="flex flex-col w-[20%] max-md:ml-0 max-md:w-full">
              <img loading="lazy" :src="item.image"
                className="shrink-0 max-w-full aspect-[1.15] w-[268px] max-md:mt-10" />
            </div>
            <div className="flex flex-col ml-5 w-[75%] max-md:ml-0 max-md:w-full">
              <div className="grow max-md:mt-10 max-md:max-w-full">
                <div className="flex gap-5 max-md:flex-col max-md:gap-0">
                  <div className="flex flex-col w-[77%] max-md:ml-0 max-md:w-full">
                    <div className="flex z-10 flex-col py-1 text-xl whitespace-nowrap max-md:max-w-full">
                      <div className="self-start text-2xl font-semibold leading-8 text-slate-800">
                        {{ item.name }}
                      </div>
                      <div className="mt-1.5 leading-8 text-ellipsis text-neutral-600 max-md:max-w-full">
                        {{ cleanHtml(item.description) }}
                      </div>
                      <div className="flex gap-5 justify-between self-start mt-1.5">

                      </div>
                    </div>
                  </div>
                  <div className="flex flex-col ml-5 w-[23%] max-md:ml-0 max-md:w-full">
                    <div className="flex flex-col grow mt-4">
                      <div className="text-3xl font-bold leading-8 text-slate-800">
                        <div class="text-lg font-bold text-orange-500">$ {{ item.offer_price }}</div>
                        <div class="text-base text-stone-900"><strike>$ {{ item.price }}</strike></div>
                      </div>
                      <div
                        className="justify-center self-start p-3 mt-5 mx-8 text-xl font-medium leading-6 text-center text-blue-600 whitespace-nowrap rounded-xl bg-blue-100 bg-opacity-30 max-md:mt-10 max-md:ml-2.5">
                        Book Now
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else-if="activeTab === 'freelancer'">
        <div
          className="px-10 pt-8 mt-2.5 mx-10 bg-white rounded-xl border-solid border-[3px] border-zinc-100 max-md:px-5 max-md:max-w-full text-wrap"
          v-for="(profile, index) in freelancers" :key="index">
          <div className="flex gap-5 max-md:flex-col max-md:gap-0">
            <div className="flex flex-col w-[20%] max-md:ml-0 max-md:w-full">
              <img loading="lazy" :src="profile.image" className="shrink-0 max-w-full aspect-[1.15] w-[268px] max-md:mt-10" />
            </div>
            <div className="flex flex-col ml-5 w-[75%] max-md:ml-0 max-md:w-full">
              <div className="grow max-md:mt-10 max-md:max-w-full">
                <div className="flex gap-5 max-md:flex-col max-md:gap-0">
                  <div className="flex flex-col w-[77%] max-md:ml-0 max-md:w-full">
                    <div className="flex z-10 flex-col py-1 text-xl whitespace-nowrap max-md:max-w-full">
                      <div className="self-start text-2xl font-semibold leading-8 text-slate-800">
                        {{profile.name}}
                      </div>
                      <div className="flex mt-1.5 items-start leading-[160%] text-slate-500 max-md:max-w-full">
                        Banglore
                      </div>
                      <div
                        className="flex mt-1.5 items-start font-semibold leading-[150%] text-ellipsis text-neutral-600 max-md:max-w-full">
                        Hii 👋 , Banglore photographer
                      </div>
                      <div className="flex mt-1.5 items-start leading-8 text-ellipsis text-neutral-600 max-md:max-w-full">
                        {{ cleanHtml(profile.description) }}
                      </div>
                      <div className="flex gap-5 justify-between self-start mt-1.5">
                        <div className="flex gap-2 items-center">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="flex flex-col ml-5 w-[23%] max-md:ml-0 max-md:w-full">
                    <div className="flex flex-col grow mt-4">
                      <div
                        className="justify-center self-start p-3 mt-24 ml-5 text-xl font-medium leading-6 text-center text-blue-600 whitespace-nowrap rounded-xl bg-blue-100 bg-opacity-30 max-md:mt-10 max-md:ml-2.5">
                        Request Quote
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="flex flex-col">
      <div class="flex flex-col px-20 pb-6 w-full bg-white max-md:px-5 max-md:max-w-full"
        v-if="activeTab === 'projects' && activeTabView === 'grid-view'">
        <div class="mt-3 max-md:pr-5 max-md:max-w-full">
          <div class="row gap-5 justify-center my-4 max-md:flex-col max-md:gap-0">
            <div class="grid-cols-3 gap-4 ml-3 w-[30%] max-md:ml-0 max-md:w-full"
              v-for="(item, index) in displayedItems" :key="index">
              <div
                class="flex flex-col grow px-4 pt-4 pb-6 w-full whitespace-nowrap bg-white rounded-lg border-solid border-[0.618px] border-black border-opacity-10 max-md:mt-10">
                <img loading="lazy" :src="item.image" class="w-full aspect-[1.56]" />
                <img loading="lazy"
                  src="https://cdn.builder.io/api/v1/image/assets/TEMP/513fe6fd8809966c0c53020be6ec564b075edbd0d140de803e9d13c5c79de42e?apiKey=023108a9c99043f18acff792c7e6bb89"
                  class="mt-4 aspect-[6.25] w-[97px]" />
                <div class="mt-1 text-lg font-semibold leading-7 text-neutral-800">
                  {{ item.name }}
                </div>
                <div class="mt-2 text-base leading-6 text-ellipsis text-neutral-600 text-truncate">
                  {{ cleanHtml(item.description) }}
                </div>
                <div class="flex gap-5 justify-between self-stretch mt-3 max-w-[359px]">
                  <div class="flex gap-2 self-start py-1 leading-[150%]">
                    <div class="text-lg font-bold text-orange-500">$ {{ item.offer_price }}</div>
                    <div class="text-base text-stone-900"><strike>$ {{ item.price }}</strike></div>
                  </div>
                  <div
                    class="justify-center px-4 py-2.5 text-base font-medium leading-5 text-center text-blue-600 whitespace-nowrap rounded-lg bg-blue-100 bg-opacity-30">
                    Book Now
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="flex gap-4 justify-center self-end mt-8">
          <button
            class="flex flex-1 justify-center items-center px-3 h-10 bg-white rounded-sm border border-solid aspect-square border-neutral-900 border-opacity-10"
            @click="prevPage" :disabled="currentPage === 1">
            <svg class="w-12 h-12 inline-block" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12l4.58-4.59z" fill="currentColor" />
            </svg>
          </button>
          <button v-for="num in totalPages" @click="page(num)" :key="num" :class="{
      'justify-center items-center px-4 h-10 text-base font-bold leading-6 text-white whitespace-nowrap bg-blue-600 rounded-sm aspect-square': num == currentPage,
      'justify-center items-center px-4 h-10 text-base leading-6 text-blue-600 whitespace-nowrap bg-white rounded-sm border border-solid aspect-square border-neutral-900 border-opacity-10': num != currentPage
    }">
            {{ num }}
          </button>
          <button
            class="flex flex-1 justify-center items-center px-3 h-10 bg-white rounded-sm border border-solid aspect-square border-neutral-900 border-opacity-10"
            @click="nextPage" :disabled="currentPage === totalPages">
            <svg class="w-12 h-12 inline-block" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12l-4.58 4.59z" fill="currentColor" />
            </svg>
          </button>
        </div>
      </div>
      <div class="flex flex-col items-start px-20 mt-12 w-full max-md:px-5 max-md:mt-10 max-md:max-w-full">
        <div class="ml-3.5 text-4xl font-medium leading-10 text-zinc-900 max-md:max-w-full">
          Recommended service
        </div>
        <div class="mt-3 ml-3.5 text-lg leading-7 text-neutral-800 max-md:max-w-full">
          Learn from Industry Experts and Enhance Your Skills.
        </div>
        <div class="self-stretch mx-3.5 mt-12 max-md:mt-10 max-md:mr-2.5 max-md:max-w-full">
          <div class="flex gap-5 max-md:flex-col max-md:gap-0">
            <div class="flex flex-col w-3/12 max-md:ml-0 max-md:w-full"
            v-for="(profile, index) in recommendedService" :key="index">
              <div
                class="flex flex-col grow px-3 pt-3 pb-12 w-full whitespace-nowrap bg-white rounded-md border-solid border-[0.47px] border-black border-opacity-10 max-md:mt-6">
                <img loading="lazy"
                  :src="profile.image"
                  class="w-full aspect-[1.56]" /><img loading="lazy"
                  src="https://cdn.builder.io/api/v1/image/assets/TEMP/c7965a1d0e8dd190ad1aa8d9564be8600e583355bcbf18614763e1542b0d71a7?apiKey=023108a9c99043f18acff792c7e6bb89"
                  class="mt-3 aspect-[6.25] w-[74px]" />
                <div class="text-sm font-semibold leading-5 text-neutral-800">
                  {{profile.name}}
                </div>
                <div class="mt-1.5 text-xs leading-5 text-ellipsis text-neutral-600 t">
                  {{cleanHtml(profile.description)}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script>
import Header from '@/components/partials/HeaderSection.vue'; // Import Header component
import Footer from '@/components/partials/FooterSection.vue'; // Import Footer component
import GoogleMap from '@/components/partials/GoogleMap.vue'; // Import Footer component
import axios from 'axios';
export default {
  components: {
    GoogleMap,
    Header, // Register Header component
    Footer // Register Footer component

  },
  data() {
    return {
      activeTabView: 'list-view',
      services: [],
      pageSize: 3,
      currentPage: 1,
      totalService: 0,
      freelancers: [],
      totalFreelancer: 0,
      recommendedService:[],
      location: null,
      activeTab: 'projects',
      backgroundImage: 'https://cdn.pixabay.com/photo/2018/09/12/12/14/man-3672010_1280.jpg',
      pageTitle: "Our Services",
      photographerProfiles: [
        {
          job: "Product Photographer",
          freelancerCount: 25,
          profilePicture: "https://api.multiavatar.com/Megan.svg",
          sampleWork: "https://cdn.pixabay.com/photo/2016/11/14/04/45/elephant-1822636_1280.jpg"
        },
        {
          job: "Event Photographer",
          freelancerCount: 35,
          profilePicture: "https://api.multiavatar.com/Adam.svg",
          sampleWork: "https://cdn.pixabay.com/photo/2016/11/14/04/45/elephant-1822636_1280.jpg"
        },
        {
          job: "Fashion Photographer",
          freelancerCount: 40,
          profilePicture: "https://api.multiavatar.com/Alice.svg",
          sampleWork: "https://cdn.pixabay.com/photo/2016/01/09/18/27/camera-1130731_1280.jpg"
        },
        {
          job: "Travel Photographer",
          freelancerCount: 28,
          profilePicture: "https://api.multiavatar.com/Ella.svg",
          sampleWork: "https://cdn.pixabay.com/photo/2016/01/09/18/27/camera-1130731_1280.jpg"
        },
        {
          job: "Food Photographer",
          freelancerCount: 18,
          profilePicture: "https://api.multiavatar.com/Nathan.svg",
          sampleWork: "https://cdn.pixabay.com/photo/2016/01/09/18/27/camera-1130731_1280.jpg"
        }
      ]
    }
  },
  mounted() {
    this.getLocation();
    axios.get('https://jivika.saveonsoftware.in/api/services')
      .then(response => {
        if (response.status != 200) {
          throw new Error('Network response was not ok');
        }
        return response.data;
      })
      .then(data => {
        // Assign the received data to the categories array
        this.services = data.data;
        this.totalService = data.data.length;
        this.recommendedService = this.services.slice(0, 5);
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
      });
    axios.get('https://jivika.saveonsoftware.in/api/providers')
      .then(response => {
        if (response.status != 200) {
          throw new Error('Network response was not ok');
        }
        return response.data;
      })
      .then(data => {
        // Assign the received data to the categories array
        this.freelancers = data.freelancer;
        this.totalFreelancer = data.freelancer.length;
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
      });
  },
  computed: {
    // Calculate the total number of pages
    totalPages() {
      return Math.ceil(this.services.length / this.pageSize);
    },
    // Calculate the items to display on the current page
    displayedItems() {
      const start = (this.currentPage - 1) * this.pageSize;
      const end = start + this.pageSize;
      return this.services.slice(start, end);
    }
  },
  methods: {
    prevPage() {
      this.currentPage--;
    },
    page(num) {
      this.currentPage = num;
    },
    nextPage() {
      this.currentPage++;
    },
    cleanHtml(html) {
      // Use a regular expression to remove HTML tags
      if(html != null)
      {
        return html.replace(/<[^>]+>/g, '');
      }else{
        return '';
      }
    },
    getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(this.showPosition, this.showError);
      } else {
        console.error("Geolocation is not supported by this browser.");
      }
    },
    showPosition(position) {
      this.location = {
        latitude: position.coords.latitude,
        longitude: position.coords.longitude
      };
    },
    showError(error) {
      console.error("Error getting location:", error);
    }
  }
}
</script>