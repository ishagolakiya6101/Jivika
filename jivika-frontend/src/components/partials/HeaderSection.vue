<template>
  <header class="header">
    <div class="container">
      <div class="logo-container">
        <h1 class="brand-name">JIVIKA</h1>
      </div>
      <nav class="navigation">
        <ul class="nav-links">
          <li><router-link to="/" class="nav-item">Home</router-link></li>
          <li><router-link to="/services" class="nav-item">Service</router-link></li>
        </ul>
      </nav>
      <div class="auth-options flex justify-between">
        <ul class=" d-flex" v-if="!isAuthenticated">
          <li>
            <button class="register-button" v-if="!isAuthenticated" @click="goToRegister">Register</button>
            <ul v-if="isOpen"
              class="dropdown flex flex-col py-3 text-sm font-bold leading-4 whitespace-nowrap bg-white rounded-lg text-neutral-600 text-opacity-90">
              <li>
                <a class="dropdown-item" @click="customerRegister">
                  <i class="ti ti-user-check me-2 ti-sm"></i>
                  <span class="w-full">Customer</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" @click="freelancerRegister">
                  <i class="ti ti-settings me-2 ti-sm"></i>
                  <span class="w-full">Freelancer</span>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <button class="login-button" v-if="!isAuthenticated" @click="goToLogin">Login</button>
          </li>
        </ul>
        <ul class="d-flex justify-end" v-if="isAuthenticated">
          <li>
            <button class="register-button" @click="profileTab">{{ User }}</button>
            <ul v-if="isOpenProfile"
              class="dropdown flex flex-col py-3 text-sm font-bold leading-4 whitespace-nowrap bg-white rounded-lg text-neutral-600 text-opacity-90">
              <li>
                <a class="dropdown-item" @click="gotoProfile">
                  <i class="ti ti-user-check me-2 ti-sm"></i>
                  <span class="w-full">Profile</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" @click="goToLogout">
                  <i class="ti ti-settings me-2 ti-sm"></i>
                  <span class="w-full">Log out</span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" v-if="showModal">
        <div class="bg-white rounded-lg p-8 max-w-md w-full">
          <button @click="closeModal" class="absolute top-0 right-40 m-4">
            <svg class="h-6 w-6 text-gray-500 hover:text-gray-700" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
          <!-- Your registration form -->
          <div class="text-4xl font-bold leading-[84px] text-neutral-900 max-md:text-4xl">
            Register
          </div>
          <div class="text-lg leading-7 text-center text-blue-600 whitespace-nowrap">
            Enter your deatils to form your account
          </div>
          <input
            class="justify-center items-start py-3 pr-16 pl-7 mt-4 max-w-full text-violet-400 whitespace-nowrap bg-slate-50 rounded-[50px] w-[461px] max-md:px-5 max-md:mt-10"
            type="text" v-model="name" placeholder="Name">
          <input
            class="justify-center items-start py-3 pr-16 pl-7 mt-4 max-w-full text-violet-400 whitespace-nowrap bg-slate-50 rounded-[50px] w-[461px] max-md:px-5 max-md:mt-10"
            type="number" v-model="phoneNumber" placeholder="Phone No.">
          <input
            class="justify-center items-start py-3 pr-16 pl-7 mt-4 max-w-full text-violet-400 whitespace-nowrap bg-slate-50 rounded-[50px] w-[461px] max-md:px-5 max-md:mt-10"
            type="email" v-model="email" placeholder="Email">
          <input
            class="justify-center items-start py-3 pr-16 pl-7 mt-4 max-w-full text-violet-400 whitespace-nowrap bg-slate-50 rounded-[50px] w-[461px] max-md:px-5 max-md:mt-10"
            type="password" v-model="password" placeholder="Enter Password">
          <input
            class="justify-center items-start py-3 pr-16 pl-7 mt-4 max-w-full text-violet-400 whitespace-nowrap bg-slate-50 rounded-[50px] w-[461px] max-md:px-5 max-md:mt-10"
            type="password" v-model="confirmPassword" placeholder="Confirm Password">
          <label for="fileInput"
            class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Upload Profile Picture
            <input id="fileInput" type="file" @change="handleFileUpload" class="hidden" ref="fileInput">
          </label>
          <select v-model="selectedOptions" multiple
            class="form-multiselect justify-center items-start py-3 pr-16 pl-7 mt-4 max-w-full text-violet-400 whitespace-nowrap bg-slate-50 rounded-[50px] w-[461px] max-md:px-5 max-md:mt-10"
            v-if="user_type == 'freelancer'">
            <option v-for="option in options" :key="option.value" :value="option.value">{{ option.label }}</option>
          </select>
          <div
            class="flex gap-2.5 self-start mt-3.5 ml-7 whitespace-nowrap leading-[150%] text-neutral-500 max-md:ml-2.5">
            <input class="form-check-input" type="checkbox" id="remember-me" />
            <label class="form-check-label" for="remember-me"> Remember Me </label>
          </div>
          <button v-on:click="signUp()"
            class="justify-center items-center px-16 py-4 mt-3 w-full text-lg font-bold leading-5 text-center text-white whitespace-nowrap bg-weather-primary max-w-[461px] rounded-[50px] max-md:px-5 max-md:mt-10 max-md:max-w-full">Sign
            Up</button>
        </div>
      </div>
    </div>
  </header>
</template>

<script>

import axios from 'axios';
import { useToast } from "vue-toastification";
export default {
  computed: {
    isAuthenticated() {
      return localStorage.getItem('authenticated');
    }
  },
  data() {
    return {
      isOpen: false,
      isOpenProfile: false,
      user_type: 'customer',
      showModal: false,
      name: '',
      email: '',
      password: '',
      script: 'https://checkout.razorpay.com/v1/checkout.js',
      confirmPassword: '',
      phoneNumber: '',
      User: '',
      selectedOptions: [],
      services: [],
      options: []
    };
  },
  mounted() {
    if (JSON.parse(localStorage.getItem('login-info'))) {
      this.User = JSON.parse(localStorage.getItem('login-info')).name;
    }
    axios.get('https://jivika.saveonsoftware.in/api/services')
      .then(response => {
        if (response.status != 200) {
          throw new Error('Network response was not ok');
        }
        return response.data;
      })
      .then(data => {
        this.options = data.data.map(option => ({ value: option.id, label: option.name }));
        this.services = data.data;
        localStorage.setItem('services', JSON.stringify(data.data));
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
      });
  },
  methods: {
    toggleDropdown() {
    },
    goToRegister() {
      this.isOpen = !this.isOpen;
      // this.$router.push({ name: 'register' });
    },
    profileTab() {
      this.isOpenProfile = !this.isOpenProfile;
      // this.$router.push({ name: 'register' });
    },
    customerRegister() {
      this.showModal = true;
      this.user_type = 'customer';
      // this.$router.push({ name: 'register' });
    },
    freelancerRegister() {
      this.showModal = true;
      this.user_type = 'freelancer';
    }, async loadRazorPay() {
      return new Promise(resolve => {
        const script = document.createElement('script')
        script.src = this.script
        script.onload = () => {
          resolve(true)
        }
        script.onerror = (e) => {
          console.log(e)
          resolve(true)
        }
        document.body.appendChild(script)
      })
    },

    async goToLogin() {
      const result = await this.loadRazorPay()
      if (!result) {
        return
      }
      var options = {
        "key": "rzp_test_p1joCfbwY8T06u",
        "amount": "2000", // 2000 paise = INR 20
        "name": "Merchant Name",
        "description": "Purchase Description",
        "order_id": "order_NnizzsjO5gDX65",
        "handler": function (response) {
          alert(response.razorpay_payment_id);
        },
        "prefill": {
          "name": "Gaurav Kumar",
          "email": "test@test.com"
        },
        "notes": {
          "address": "Hello World"
        },
        "theme": {
          "color": "#F37254"
        }
      };
      var rzp1 = new window.Razorpay(options);
      rzp1.open();

      // this.$router.push({ name: 'login' });
    },
    gotoProfile() {
      this.$router.push({ name: 'profile' });
    },
    goToLogout() {
      localStorage.setItem('authenticated', false)
      localStorage.clear('login-info')
      this.$router.push({ name: 'login' });
    },
    signUp() {
      axios.post("https://jivika.saveonsoftware.in/api/register",
        {
          email: this.email,
          name: this.name,
          phoneNumber: this.phoneNumber,
          password: this.password,
          password_confirmation: this.confirmPassword,
          user_type: this.user_type,
          description: '',
          services: this.selectedOptions,
          profile_image: this.$refs.fileInput.files[0]
        }, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
        .then(response => {
          // Handle successful response

          localStorage.setItem('login-info', JSON.stringify(response.data.data))
          this.showModal = false;
          const toast = useToast();
          toast.success(response.data.success);
          // Reset form fields when modal is closed
          this.email = '';
          this.name = '';
          this.phoneNumber = '';
          this.password = '';
          this.confirmPassword = '';
          localStorage.setItem('authenticated', true)
        })
        .catch(error => {
          // Handle error
          const toast = useToast();
          toast.error(error);
          // console.error('Response data:', error.response);
        });
    },
    closeModal() {
      this.showModal = false;
      // Reset form fields when modal is closed
      this.email = '';
      this.name = '';
      this.phoneNumber = '';
      this.password = '';
      this.confirmPassword = '';
    },
  }
}
</script>