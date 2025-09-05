<template>
    <div
        class="flex flex-col items-center px-20 pt-8 pb-12 text-base leading-5 bg-white shadow-2xl max-w-[675px] rounded-[32px] max-md:px-5">
        <div class="text-6xl font-bold leading-[84px] text-neutral-900 max-md:text-4xl">
            Login
        </div>
        <div class="text-lg leading-7 text-center text-blue-600 whitespace-nowrap">
            We'll send a confirmation code to your email.<br />Sign in with
            <span class="text-blue-600">+91 9988***679</span>
        </div>
        <div class="register">
            <input
                class="justify-center items-start py-3 pr-16 pl-7 mt-12 max-w-full text-violet-400 whitespace-nowrap bg-slate-50 rounded-[50px] w-[461px] max-md:px-5 max-md:mt-10"
                type="text" v-model="email" placeholder="Email">
            <input
                class="justify-center items-start py-3 pr-16 pl-7 mt-12 max-w-full text-violet-400 whitespace-nowrap bg-slate-50 rounded-[50px] w-[461px] max-md:px-5 max-md:mt-10"
                type="password" v-model="password" placeholder="Enter Password">
            <div
                class="flex gap-2.5 self-start mt-3.5 ml-7 whitespace-nowrap leading-[150%] text-neutral-500 max-md:ml-2.5">
                <input class="form-check-input" type="checkbox" id="remember-me" />
                <label class="form-check-label" for="remember-me"> Remember Me </label>
            </div>
            <button v-on:click="signIn()"
                class="justify-center items-center px-16 py-4 mt-12 w-full text-lg font-bold leading-5 text-center text-white whitespace-nowrap bg-weather-primary max-w-[461px] rounded-[50px] max-md:px-5 max-md:mt-10 max-md:max-w-full">Login</button>
        </div>
        <div
            class="justify-center items-center px-16 mt-8 max-w-full text-center whitespace-nowrap text-zinc-500 w-[431px] max-md:px-5">
            Or, Login with your email
        </div>
        <div
            class="flex gap-5 justify-between mt-9 text-lg font-bold leading-5 text-center whitespace-nowrap text-zinc-500 max-md:flex-wrap max-md:max-w-full">
            <div
                class="flex gap-2.5 justify-between px-14 py-3.5 border border-solid border-zinc-500 rounded-[50px] max-md:px-5">
                <img loading="lazy"
                    src="https://cdn.builder.io/api/v1/image/assets/TEMP/4d4ebfbedcf72b924310a228a73beea30e1501ebe33083a5ff723b5f50dad61e?apiKey=023108a9c99043f18acff792c7e6bb89"
                    class="w-6 aspect-square" />
                <div class="grow my-auto">Google</div>
            </div>
            <div
                class="flex gap-2.5 justify-between px-10 py-3.5 border border-solid border-zinc-500 rounded-[50px] max-md:px-5">
                <img loading="lazy"
                    src="https://cdn.builder.io/api/v1/image/assets/TEMP/1d3b0705653e6753b771b1589bd03f091d66c556b58f09ca1b0bbf6c08d39d3d?apiKey=023108a9c99043f18acff792c7e6bb89"
                    class="w-6 aspect-square" />
                <div class="grow my-auto">Facebook</div>
            </div>
        </div>
        <div class="flex gap-0 justify-center mt-24 whitespace-nowrap leading-[150%] max-md:mt-10">
            <div class="grow text-neutral-500">Don't have an account ? </div>
            <a href="javascript:void(0)" v-on:click="signUp()" class="text-blue-600">Register</a>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { useToast } from "vue-toastification";
export default {
    name: "SignIn",
    data() {
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        signUp() {
            this.$router.push({ name: 'register' });
        },
        signIn() {
            axios.post("https://jivika.saveonsoftware.in/api/login",
                {
                    email: this.email,
                    password: this.password
                })
                .then(response => {
                    console.log(response);
                    // Handle successful response
                    if (response.data.success) {
                        const toast = useToast();
                        toast.success("Login Successful");
                        localStorage.setItem('login-info', JSON.stringify(response.data.data))
                        this.$router.push({ name: "home" });
                        localStorage.setItem('authenticated', true)
                    } else {
                        localStorage.clear('login-info')
                        const toast = useToast();
                        toast.error("Login Failed");
                    }
                })
                .catch(error => {
                    // Handle error
                    console.error('Error:', error.message);
                    const toast = useToast();
                    toast.success("Login failed");
                    console.error('Response data:', error.response.data.errors);
                });
        }
    }
}
</script>