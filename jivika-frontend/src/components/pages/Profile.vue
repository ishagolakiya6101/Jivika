<template>
    <Header />
    <div>


        <div class="mt-20">
            <div class="row">
                <div class="flex flex-col bg-gray col-2">
                    <button @click="toggleSidebar" class="text-white p-4">Toggle Sidebar</button>
                    <router-link to="/">Home</router-link>
                    <router-link to="/profile">About</router-link>
                </div>
                <div class="col-10">
                    <h1>Profile</h1>
                    <div class="register">
                        <input
                            class="justify-center items-start py-3 pr-16 pl-7 mr-8 ml-8 mt-12 max-w-full text-violet-400 whitespace-nowrap bg-slate-50 rounded-[50px] w-[461px] w-full max-md:px-5 max-md:mt-10"
                            type="text" v-model="name" placeholder="Name">
                        <input
                            class="justify-center items-start py-3 pr-16 pl-7 mr-8 ml-8 mt-12 max-w-full text-violet-400 whitespace-nowrap bg-slate-50 rounded-[50px] w-[461px] w-full max-md:px-5 max-md:mt-10"
                            type="number" v-model="phonenumber" placeholder="Phone No.">
                        <input
                            class="justify-center items-start py-3 pr-16 pl-7 mr-8 ml-8 mt-12 max-w-full text-violet-400 whitespace-nowrap bg-slate-50 rounded-[50px] w-[461px] w-full max-md:px-5 max-md:mt-10"
                            type="email" v-model="email" placeholder="Email">
                        <input
                            class="justify-center items-start py-3 pr-16 pl-7 mr-8 ml-8 mt-12 max-w-full text-violet-400 whitespace-nowrap bg-slate-50 rounded-[50px] w-[461px] w-full max-md:px-5 max-md:mt-10"
                            v-if="user_type == 'freelancer'" type="text" v-model="title" placeholder="Title">
                        <textarea v-model="description" placeholder="Description" id="" cols="30" rows="4"
                            v-if="user_type == 'freelancer'" class="justify-center items-start py-3 pr-16 pl-7 mr-8 ml-8 mt-12 max-w-full text-violet-400 whitespace-nowrap bg-slate-50 rounded-[50px] w-[461px] w-full max-md:px-5 max-md:mt-10"></textarea>
                        <div class="mt-12 " v-if="user_type == 'freelancer'">
                            <label class="flex justify-start mr-8 ml-8 " for="selectedOptions">Select Services</label>
                            <select v-model="selectedOptions" multiple
                            class="form-multiselect justify-center items-start py-3 pr-16 pl-7 mr-8 ml-8 max-w-full text-violet-400 whitespace-nowrap bg-slate-50 rounded-[50px] w-[461px] w-full max-md:px-5 max-md:mt-10">
                            <option v-for="option in options" :key="option.value" :value="option.value">{{ option.label
                                }}</option>
                        </select>

                        </div>
                        <button v-on:click="profileUpdate()"
                            class="justify-center items-center px-16 py-4 mt-12 text-lg font-bold leading-5 text-center text-white whitespace-nowrap bg-weather-primary max-w-[461px] w-full rounded-[50px] max-md:px-5 max-md:mt-10 max-md:max-w-full">Update
                            Profile</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <Footer />
</template>

<script>
import Header from '@/components/partials/HeaderSection.vue'; // Import Header component
import Footer from '@/components/partials/FooterSection.vue';
import axios from 'axios';
import { useToast } from "vue-toastification";
export default {
    data() {
        return {
            name: '',
            phonenumber: '',
            profile: '',
            email: '',
            description: '',
            title: '',
            uuid: '',
            selectedOptions: [],
            user_type:'customer'
        }
    },
    mounted() {
        var data = JSON.parse(localStorage.getItem('login-info'));
        this.user_type = data.user_type;
        this.name = data.name;
        this.phonenumber = data.phonenumber;
        this.profile = data.profile;
        this.description = data.description;
        this.title = data.title;
        this.uuid = data.uuid;
        this.email = data.email;
        this.selectedOptions = data.services;
        var services = JSON.parse(localStorage.getItem('services'));
        this.options = services.map(option => ({ value: option.id, label: option.name }));
    },
    components: {
        Header, // Register Header component
        Footer // Register Footer component
    },
    methods: {

        profileUpdate() {
            axios.post("https://jivika.saveonsoftware.in/api/profile",
                {
                    name: this.name,
                    phonenumber: this.phoneNumber,
                    profile: this.profile,
                    description: this.description,
                    uuid: this.uuid,
                    title: this.title,
                    services: this.selectedOptions
                })
                .then(response => {
                    // Handle successful response
                    // console.log(response.data.success);
                    const toast = useToast();
                    toast.success(response.data.success);
                    this.email = response.data.data.email;
                    this.name = response.data.data.name;
                    this.phonenumber = response.data.data.phonenumber;
                    localStorage.setItem('login-info', JSON.stringify(response.data.data))
                })
                .catch(error => {
                    // Handle error
                    console.error('Error:', error);
                    // console.error('Response data:', error.response);
                });
        },
    }
}
</script>