<template>
  <div>
    <Header />
    <div class="page-title-section" :style="{ backgroundImage: url(${backgroundImage}) }">
    </div>
    <div class="mt-20 text-4xl font-medium leading-10 whitespace-nowrap text-zinc-900 max-md:mt-10">
      How it work
    </div>
    <div class="mt-3 text-lg leading-7 text-neutral-800 max-md:max-w-full">
      Learn from Industry Experts and Enhance Your Skills.
    </div>
    <div class="tabs">
      <ul class="tabs-nav">
        <li><a href="#tab-1">Features</a></li>
        <li><a href="#tab-2">Details</a></li>
      </ul>
      <div class="tabs-stage">
        <div id="tab-1">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec neque nisi, dictum aliquet lectus.
          </p>
        </div>
        <div id="tab-2">
          <p>Phasellus pharetra aliquet viverra. Donec scelerisque tincidunt diam, eu fringilla urna auctor at.</p>
        </div>
      </div>
    </div>
    <div class="flex gap-5 justify-center mt-10 text-lg leading-5 text-center whitespace-nowrap mx-20">
      <button
        :class="{ 'justify-center px-9 py-6 font-bold text-white bg-weather-primary rounded-[40px] max-md:px-5': activeTab === 'customer', 'justify-center px-9 py-6 text-weather-primary bg-white border border-solid border-[color:var(--Foundation-Blue-blue-300,#707B9E)] rounded-[36.55px] max-md:px-5': activeTab !== 'customer' }"
        @click="activeTab = 'customer'">
        Customer
      </button>
      <button
        :class="{ 'justify-center px-9 py-6 font-bold text-white bg-weather-primary rounded-[40px] max-md:px-5': activeTab === 'freelancer', 'justify-center px-9 py-6 text-weather-primary bg-white border border-solid border-[color:var(--Foundation-Blue-blue-300,#707B9E)] rounded-[36.55px] max-md:px-5': activeTab !== 'freelancer' }"
        @click="activeTab = 'freelancer'">
        Freelancer
      </button>
    </div>
    <div class="px-5 justify-center mt-12 w-full max-w-[1234px] max-md:mt-10 max-md:max-w-full" v-if="activeTab === 'customer'">
      <div class="flex gap-5 max-md:flex-col max-md:gap-0">
        <div class="flex flex-col w-3/12 max-md:ml-0 max-md:w-full">
          <div class="flex flex-col px-4 py-6 w-full rounded-xl bg-stone-50 max-md:mt-5">
            <div
              class="flex justify-center items-center self-center bg-weather-primary aspect-square h-[72px] rounded-[80px] w-[72px]">
              <img loading="lazy"
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/90d44c10d2a29b27e7032a847cdbb71fd7bc47e55d87dda0e348620366581886?apiKey=023108a9c99043f18acff792c7e6bb89&width=100"
                class="aspect-square" />
            </div>
            <div class="mt-6 text-lg font-medium leading-7 text-center lowercase text-zinc-900">
              Search fashion
              <span class="lowercase">AND LIFESTYLE FREELANCERS</span>
            </div>
            <div class="mt-3 text-sm leading-5 text-center text-gray-500">
              Download our app to search and find fashion and lifestyle
              freelancers.
            </div>
          </div>
        </div>
        <div class="flex flex-col ml-5 w-3/12 max-md:ml-0 max-md:w-full">
          <div class="flex flex-col px-4 py-6 w-full bg-white rounded-xl shadow-2xl max-md:mt-5">
            <div
              class="flex justify-center items-center self-center bg-weather-primary aspect-square h-[72px] rounded-[80px] w-[72px]">
              <img loading="lazy"
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/25ad57dbad31d468cc95c61bd0d6890e51cdc6b8f8d5db1004e74e03f5af3c63?apiKey=023108a9c99043f18acff792c7e6bb89"
                class="aspect-square" />
            </div>
            <div class="mt-6 text-lg font-medium leading-7 text-center lowercase text-zinc-900">
              <span class="uppercase">S</span>ELECT &<span class="uppercase">
                c</span>HOOSE SERVICE LOCATION
            </div>
            <div class="mt-3 text-sm leading-5 text-center text-gray-500">
              Filter & Select based on prices availability and ratings.
            </div>
          </div>
        </div>
        <div class="flex flex-col ml-5 w-3/12 max-md:ml-0 max-md:w-full">
          <div class="flex flex-col grow px-4 py-6 w-full rounded-xl bg-stone-50 max-md:mt-5">
            <div
              class="flex justify-center items-center self-center bg-weather-primary aspect-square h-[72px] rounded-[80px] w-[72px]">
              <img loading="lazy"
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/0cd1ede51fc4de6362451b78d4ada0c5e2a6eee528f6f0c0b2c8d3a547ec445d?apiKey=023108a9c99043f18acff792c7e6bb89"
                class="aspect-square" />
            </div>
            <div class="mt-6 text-lg font-medium leading-7 text-center lowercase text-zinc-900">
              <span class="uppercase">N</span>EGOTIATE AND PAY<br />
            </div>
            <div class="mt-3 text-sm leading-5 text-center text-gray-500">
              Chat or negotiate with freelancer, and pay off the app.
            </div>
          </div>
        </div>
        <div class="flex flex-col ml-5 w-3/12 max-md:ml-0 max-md:w-full">
          <div class="flex flex-col grow px-4 py-6 w-full rounded-xl bg-stone-50 max-md:mt-5">
            <div
              class="flex justify-center items-center self-center bg-weather-primary aspect-square h-[72px] rounded-[80px] w-[72px]">
              <img loading="lazy"
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/e16ab4922fa49e41275a19ba152a48eca5a7a52d95db46a3fd01f0bf15054cb7?apiKey=023108a9c99043f18acff792c7e6bb89"
                class="aspect-square" />
            </div>
            <div class="mt-6 text-lg font-medium leading-7 text-center lowercase text-zinc-900">
              <span class="uppercase">E</span>NJOY SERVICE<br />
            </div>
            <div class="mt-3 text-sm leading-5 text-center text-gray-500">
              Enjoy your selected fashion and lifestyle service, and rate your
              freelancer.
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="px-5 justify-center mt-12 w-full max-w-[1234px] max-md:mt-10 max-md:max-w-full" v-else-if="activeTab === 'freelancer'">
      <div class="flex gap-5 max-md:flex-col max-md:gap-0">
        <div class="flex flex-col w-3/12 max-md:ml-0 max-md:w-full">
          <div class="flex flex-col grow px-4 py-6 w-full rounded-xl bg-stone-50 max-md:mt-5">
            <div
              class="flex justify-center items-center self-center bg-weather-primary aspect-square h-[72px] rounded-[80px] w-[72px]">
              <img loading="lazy"
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/3dc55318d1f1a5f21ae69d97ce67f04a9bd667ace5597c25d779dd54f45edff1?apiKey=023108a9c99043f18acff792c7e6bb89"
                class="aspect-square" />
            </div>
            <div class="mt-6 text-lg font-medium leading-7 text-center lowercase text-zinc-900">
              <span class="uppercase">C</span>REATE SERVICE <br />PROFILE
            </div>
            <div class="mt-3 text-sm leading-5 text-center text-gray-500">
              Create profile, picture portfolio and personal price-list.<br />
            </div>
          </div>
        </div>
        <div class="flex flex-col ml-5 w-3/12 max-md:ml-0 max-md:w-full">
          <div class="flex flex-col grow px-4 py-6 w-full bg-white rounded-xl shadow-2xl max-md:mt-5">
            <div
              class="flex justify-center items-center self-center bg-weather-primary aspect-square h-[72px] rounded-[80px] w-[72px]">
              <img loading="lazy"
                srcSet="https://cdn.builder.io/api/v1/image/assets/TEMP/4389c81dc2e5ab3ca622428450f802832509804e9f172ad0214e9affd5b67163?apiKey=023108a9c99043f18acff792c7e6bb89&width=100 100w, https://cdn.builder.io/api/v1/image/assets/TEMP/4389c81dc2e5ab3ca622428450f802832509804e9f172ad0214e9affd5b67163?apiKey=023108a9c99043f18acff792c7e6bb89&width=200 200w, https://cdn.builder.io/api/v1/image/assets/TEMP/4389c81dc2e5ab3ca622428450f802832509804e9f172ad0214e9affd5b67163?apiKey=023108a9c99043f18acff792c7e6bb89&width=400 400w, https://cdn.builder.io/api/v1/image/assets/TEMP/4389c81dc2e5ab3ca622428450f802832509804e9f172ad0214e9affd5b67163?apiKey=023108a9c99043f18acff792c7e6bb89&width=800 800w, https://cdn.builder.io/api/v1/image/assets/TEMP/4389c81dc2e5ab3ca622428450f802832509804e9f172ad0214e9affd5b67163?apiKey=023108a9c99043f18acff792c7e6bb89&width=1200 1200w, https://cdn.builder.io/api/v1/image/assets/TEMP/4389c81dc2e5ab3ca622428450f802832509804e9f172ad0214e9affd5b67163?apiKey=023108a9c99043f18acff792c7e6bb89&width=1600 1600w, https://cdn.builder.io/api/v1/image/assets/TEMP/4389c81dc2e5ab3ca622428450f802832509804e9f172ad0214e9affd5b67163?apiKey=023108a9c99043f18acff792c7e6bb89&width=2000 2000w, https://cdn.builder.io/api/v1/image/assets/TEMP/4389c81dc2e5ab3ca622428450f802832509804e9f172ad0214e9affd5b67163?apiKey=023108a9c99043f18acff792c7e6bb89"
                class="aspect-square" />
            </div>
            <div class="mt-6 text-lg font-medium leading-7 text-center lowercase text-zinc-900">
              <span class="uppercase">A</span>CCEPT OR DECLINE SERVICES REQUEST
            </div>
            <div class="mt-3 text-sm leading-5 text-center text-gray-500">
              Accept service request based on client's selected service, time, and
              location preference
            </div>
          </div>
        </div>
        <div class="flex flex-col ml-5 w-3/12 max-md:ml-0 max-md:w-full">
          <div class="flex flex-col grow px-4 py-6 w-full rounded-xl bg-stone-50 max-md:mt-5">
            <div
              class="flex justify-center items-center self-center bg-weather-primary aspect-square h-[72px] rounded-[80px] w-[72px]">
              <img loading="lazy"
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/dafeed52ede5a2ceaa31de449df30dfcd396fe57690cfe2afefec6fb1f8017e0?apiKey=023108a9c99043f18acff792c7e6bb89"
                class="aspect-square" />
            </div>
            <div class="mt-6 text-lg font-medium leading-7 text-center lowercase text-zinc-900">
              <span class="uppercase">O</span>FFER SERVICE<br />
            </div>
            <div class="mt-3 text-sm leading-5 text-center text-gray-500">
              Meet clients on agreed date, time and location, and offer booked
              service.<br />
            </div>
          </div>
        </div>
        <div class="flex flex-col ml-5 w-3/12 max-md:ml-0 max-md:w-full">
          <div class="flex flex-col grow px-4 py-6 w-full rounded-xl bg-stone-50 max-md:mt-5">
            <div
              class="flex justify-center items-center self-center bg-weather-primary aspect-square h-[72px] rounded-[80px] w-[72px]">
              <img loading="lazy"
                src="https://cdn.builder.io/api/v1/image/assets/TEMP/12d077429f91410b0a0782d9a4a8ec33004d2d8ca01b98d734371ca89ba6ee3b?apiKey=023108a9c99043f18acff792c7e6bb89"
                class="aspect-square" />
            </div>
            <div class="mt-6 text-lg font-medium leading-7 text-center uppercase text-zinc-900">
              G<span class="lowercase">et Paid</span><br />
            </div>
            <div class="mt-3 text-sm leading-5 text-center text-gray-500">
              Get paid directly off the app through your preferred method.<br />
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-12 text-4xl font-medium leading-10 whitespace-nowrap text-zinc-900 max-md:mt-10">
      Nearest service
    </div>
    <div class="mt-3 text-lg leading-7 text-neutral-800 max-md:max-w-full">
      Learn from Industry Experts and Enhance Your Skills.
    </div>
    <div class="flex flex-col self-stretch pt-12 mt-8 w-full bg-neutral-100 max-md:max-w-full">
      <div class="flex gap-4 px-5 text-lg leading-5 w-50 text-stone-500 max-md:flex-wrap max-md:max-w-full">
        <div class="flex flex-col flex-1 justify-center p-2 rounded-lg border border-solid border-zinc-300">
          <div class="flex gap-5 justify-between">
            <div class="my-auto">⭐ 4.5</div>
            <img loading="lazy"
              src="https://cdn.builder.io/api/v1/image/assets/TEMP/c6c658011f20a4123634853c60cc632fc3e65890e1e3676d614688838246f750?apiKey=023108a9c99043f18acff792c7e6bb89"
              class="w-6 aspect-square" />
          </div>
        </div>
        <div class="flex flex-col flex-1 justify-center p-2 rounded-lg border border-solid border-zinc-300">
          <div class="flex gap-5 justify-between">
            <div class="my-auto">50m - 85m</div>
            <img loading="lazy"
              src="https://cdn.builder.io/api/v1/image/assets/TEMP/c6c658011f20a4123634853c60cc632fc3e65890e1e3676d614688838246f750?apiKey=023108a9c99043f18acff792c7e6bb89"
              class="w-6 aspect-square" />
          </div>
        </div>
        <div class="justify-center p-2 rounded-lg border border-solid border-zinc-300">
          <div class="flex gap-5 justify-between">
            <div class="flex-auto my-auto">₹500 - ₹850</div>
            <img loading="lazy"
              src="https://cdn.builder.io/api/v1/image/assets/TEMP/c6c658011f20a4123634853c60cc632fc3e65890e1e3676d614688838246f750?apiKey=023108a9c99043f18acff792c7e6bb89"
              class="w-6 aspect-square" />
          </div>
        </div>
      </div>
      <div class="self-center mt-1.5 w-full max-w-[1284px] max-md:max-w-full">
        <div class="flex gap-5 max-md:flex-col max-md:gap-0 max-md:">
          <div class="flex flex-col w-[43%] max-md:ml-0 max-md:w-full">
            <div class="flex flex-col grow pb-5 font-medium max-md:mt-10 max-md:max-w-full">
              <div
                class="flex flex-col justify-center p-2.5 mt-10 rounded-lg bg-zinc-50 max-md:mt-10 max-md:max-w-full">
                <div class="flex gap-5 justify-between px-px max-md:flex-wrap max-md:max-w-full">
                  <div class="flex flex-col self-start">
                    <div class="text-lg leading-5 text-center text-weather-primary">
                      Family Photographer
                    </div>
                    <div class="flex gap-1 justify-between mt-2.5 text-sm leading-5 text-stone-500">
                      <div class="my-auto w-3 h-3 bg-lime-600 rounded-full"></div>
                      <div class="flex-auto">45 freelancer</div>
                    </div>
                    <img loading="lazy"
                      srcSet="https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=100 100w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=200 200w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=400 400w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=800 800w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=1200 1200w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=1600 1600w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=2000 2000w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89"
                      class="mt-2.5 max-w-full aspect-[3.23] w-[116px]" />
                  </div>
                  <img loading="lazy"
                    srcSet="https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=100 100w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=200 200w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=400 400w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=800 800w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=1200 1200w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=1600 1600w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=2000 2000w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89"
                    class="aspect-[0.99] w-[95px]" />
                </div>
              </div>
              <div class="flex flex-col justify-center p-2.5 mt-3 rounded-lg bg-zinc-50 max-md:max-w-full">
                <div class="flex gap-5 justify-between px-px max-md:flex-wrap max-md:max-w-full">
                  <div class="flex flex-col self-start">
                    <div class="text-lg leading-5 text-center text-weather-primary">
                      Nature Photographer
                    </div>
                    <div class="flex gap-1 justify-between mt-2.5 text-sm leading-5 text-stone-500">
                      <div class="my-auto w-3 h-3 bg-lime-600 rounded-full"></div>
                      <div class="flex-auto">45 freelancer</div>
                    </div>
                    <img loading="lazy"
                      srcSet="https://cdn.builder.io/api/v1/image/assets/TEMP/cfecbe0181c315cca64f27d89122240993d02d0aca3eb156d3405b8a102727fc?apiKey=023108a9c99043f18acff792c7e6bb89&width=100 100w, https://cdn.builder.io/api/v1/image/assets/TEMP/cfecbe0181c315cca64f27d89122240993d02d0aca3eb156d3405b8a102727fc?apiKey=023108a9c99043f18acff792c7e6bb89&width=200 200w, https://cdn.builder.io/api/v1/image/assets/TEMP/cfecbe0181c315cca64f27d89122240993d02d0aca3eb156d3405b8a102727fc?apiKey=023108a9c99043f18acff792c7e6bb89&width=400 400w, https://cdn.builder.io/api/v1/image/assets/TEMP/cfecbe0181c315cca64f27d89122240993d02d0aca3eb156d3405b8a102727fc?apiKey=023108a9c99043f18acff792c7e6bb89&width=800 800w, https://cdn.builder.io/api/v1/image/assets/TEMP/cfecbe0181c315cca64f27d89122240993d02d0aca3eb156d3405b8a102727fc?apiKey=023108a9c99043f18acff792c7e6bb89&width=1200 1200w, https://cdn.builder.io/api/v1/image/assets/TEMP/cfecbe0181c315cca64f27d89122240993d02d0aca3eb156d3405b8a102727fc?apiKey=023108a9c99043f18acff792c7e6bb89&width=1600 1600w, https://cdn.builder.io/api/v1/image/assets/TEMP/cfecbe0181c315cca64f27d89122240993d02d0aca3eb156d3405b8a102727fc?apiKey=023108a9c99043f18acff792c7e6bb89&width=2000 2000w, https://cdn.builder.io/api/v1/image/assets/TEMP/cfecbe0181c315cca64f27d89122240993d02d0aca3eb156d3405b8a102727fc?apiKey=023108a9c99043f18acff792c7e6bb89"
                      class="mt-2.5 max-w-full aspect-[3.23] w-[116px]" />
                  </div>
                  <img loading="lazy"
                    srcSet="https://cdn.builder.io/api/v1/image/assets/TEMP/fab34790ad2a9a59d169be0cb8de48cee685211e3fedc707dd5d357643122b85?apiKey=023108a9c99043f18acff792c7e6bb89&width=100 100w, https://cdn.builder.io/api/v1/image/assets/TEMP/fab34790ad2a9a59d169be0cb8de48cee685211e3fedc707dd5d357643122b85?apiKey=023108a9c99043f18acff792c7e6bb89&width=200 200w, https://cdn.builder.io/api/v1/image/assets/TEMP/fab34790ad2a9a59d169be0cb8de48cee685211e3fedc707dd5d357643122b85?apiKey=023108a9c99043f18acff792c7e6bb89&width=400 400w, https://cdn.builder.io/api/v1/image/assets/TEMP/fab34790ad2a9a59d169be0cb8de48cee685211e3fedc707dd5d357643122b85?apiKey=023108a9c99043f18acff792c7e6bb89&width=800 800w, https://cdn.builder.io/api/v1/image/assets/TEMP/fab34790ad2a9a59d169be0cb8de48cee685211e3fedc707dd5d357643122b85?apiKey=023108a9c99043f18acff792c7e6bb89&width=1200 1200w, https://cdn.builder.io/api/v1/image/assets/TEMP/fab34790ad2a9a59d169be0cb8de48cee685211e3fedc707dd5d357643122b85?apiKey=023108a9c99043f18acff792c7e6bb89&width=1600 1600w, https://cdn.builder.io/api/v1/image/assets/TEMP/fab34790ad2a9a59d169be0cb8de48cee685211e3fedc707dd5d357643122b85?apiKey=023108a9c99043f18acff792c7e6bb89&width=2000 2000w, https://cdn.builder.io/api/v1/image/assets/TEMP/fab34790ad2a9a59d169be0cb8de48cee685211e3fedc707dd5d357643122b85?apiKey=023108a9c99043f18acff792c7e6bb89"
                    class="aspect-square w-[95px]" />
                </div>
              </div>
              <div class="flex flex-col justify-center p-2.5 mt-3 rounded-lg bg-zinc-50 max-md:max-w-full">
                <div class="flex gap-5 justify-between px-px max-md:flex-wrap max-md:max-w-full">
                  <div class="flex flex-col self-start">
                    <div class="text-lg leading-5 text-center text-weather-primary">
                      Micro Photographer
                    </div>
                    <div class="flex gap-1 justify-between mt-2.5 text-sm leading-5 text-stone-500">
                      <div class="my-auto w-3 h-3 bg-lime-600 rounded-full"></div>
                      <div class="flex-auto">45 freelancer</div>
                    </div>
                    <img loading="lazy"
                      srcSet="https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=100 100w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=200 200w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=400 400w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=800 800w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=1200 1200w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=1600 1600w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=2000 2000w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89"
                      class="mt-2.5 max-w-full aspect-[3.23] w-[116px]" />
                  </div>
                  <img loading="lazy"
                    srcSet="https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=100 100w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=200 200w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=400 400w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=800 800w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=1200 1200w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=1600 1600w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=2000 2000w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89"
                    class="aspect-[0.99] w-[95px]" />
                </div>
              </div>
              <div class="flex flex-col justify-center p-2.5 mt-3 rounded-lg bg-zinc-50 max-md:max-w-full">
                <div class="flex gap-5 justify-between px-px max-md:flex-wrap max-md:max-w-full">
                  <div class="flex flex-col self-start">
                    <div class="text-lg leading-5 text-center text-weather-primary">
                      Group Photographer
                    </div>
                    <div class="flex gap-1 justify-between mt-2.5 text-sm leading-5 text-stone-500">
                      <div class="my-auto w-3 h-3 bg-lime-600 rounded-full"></div>
                      <div class="flex-auto">45 freelancer</div>
                    </div>
                    <img loading="lazy"
                      srcSet="https://cdn.builder.io/api/v1/image/assets/TEMP/cfecbe0181c315cca64f27d89122240993d02d0aca3eb156d3405b8a102727fc?apiKey=023108a9c99043f18acff792c7e6bb89&width=100 100w, https://cdn.builder.io/api/v1/image/assets/TEMP/cfecbe0181c315cca64f27d89122240993d02d0aca3eb156d3405b8a102727fc?apiKey=023108a9c99043f18acff792c7e6bb89&width=200 200w, https://cdn.builder.io/api/v1/image/assets/TEMP/cfecbe0181c315cca64f27d89122240993d02d0aca3eb156d3405b8a102727fc?apiKey=023108a9c99043f18acff792c7e6bb89&width=400 400w, https://cdn.builder.io/api/v1/image/assets/TEMP/cfecbe0181c315cca64f27d89122240993d02d0aca3eb156d3405b8a102727fc?apiKey=023108a9c99043f18acff792c7e6bb89&width=800 800w, https://cdn.builder.io/api/v1/image/assets/TEMP/cfecbe0181c315cca64f27d89122240993d02d0aca3eb156d3405b8a102727fc?apiKey=023108a9c99043f18acff792c7e6bb89&width=1200 1200w, https://cdn.builder.io/api/v1/image/assets/TEMP/cfecbe0181c315cca64f27d89122240993d02d0aca3eb156d3405b8a102727fc?apiKey=023108a9c99043f18acff792c7e6bb89&width=1600 1600w, https://cdn.builder.io/api/v1/image/assets/TEMP/cfecbe0181c315cca64f27d89122240993d02d0aca3eb156d3405b8a102727fc?apiKey=023108a9c99043f18acff792c7e6bb89&width=2000 2000w, https://cdn.builder.io/api/v1/image/assets/TEMP/cfecbe0181c315cca64f27d89122240993d02d0aca3eb156d3405b8a102727fc?apiKey=023108a9c99043f18acff792c7e6bb89"
                      class="mt-2.5 max-w-full aspect-[3.23] w-[116px]" />
                  </div>
                  <img loading="lazy"
                    srcSet="https://cdn.builder.io/api/v1/image/assets/TEMP/fab34790ad2a9a59d169be0cb8de48cee685211e3fedc707dd5d357643122b85?apiKey=023108a9c99043f18acff792c7e6bb89&width=100 100w, https://cdn.builder.io/api/v1/image/assets/TEMP/fab34790ad2a9a59d169be0cb8de48cee685211e3fedc707dd5d357643122b85?apiKey=023108a9c99043f18acff792c7e6bb89&width=200 200w, https://cdn.builder.io/api/v1/image/assets/TEMP/fab34790ad2a9a59d169be0cb8de48cee685211e3fedc707dd5d357643122b85?apiKey=023108a9c99043f18acff792c7e6bb89&width=400 400w, https://cdn.builder.io/api/v1/image/assets/TEMP/fab34790ad2a9a59d169be0cb8de48cee685211e3fedc707dd5d357643122b85?apiKey=023108a9c99043f18acff792c7e6bb89&width=800 800w, https://cdn.builder.io/api/v1/image/assets/TEMP/fab34790ad2a9a59d169be0cb8de48cee685211e3fedc707dd5d357643122b85?apiKey=023108a9c99043f18acff792c7e6bb89&width=1200 1200w, https://cdn.builder.io/api/v1/image/assets/TEMP/fab34790ad2a9a59d169be0cb8de48cee685211e3fedc707dd5d357643122b85?apiKey=023108a9c99043f18acff792c7e6bb89&width=1600 1600w, https://cdn.builder.io/api/v1/image/assets/TEMP/fab34790ad2a9a59d169be0cb8de48cee685211e3fedc707dd5d357643122b85?apiKey=023108a9c99043f18acff792c7e6bb89&width=2000 2000w, https://cdn.builder.io/api/v1/image/assets/TEMP/fab34790ad2a9a59d169be0cb8de48cee685211e3fedc707dd5d357643122b85?apiKey=023108a9c99043f18acff792c7e6bb89"
                    class="aspect-square w-[95px]" />
                </div>
              </div>
              <div class="flex flex-col justify-center p-2.5 mt-3 rounded-lg bg-zinc-50 max-md:max-w-full">
                <div class="flex gap-5 justify-between px-px max-md:flex-wrap max-md:max-w-full">
                  <div class="flex flex-col self-start">
                    <div class="text-lg leading-5 text-center text-weather-primary">
                      Nature Photographer
                    </div>
                    <div class="flex gap-1 justify-between mt-2.5 text-sm leading-5 text-stone-500">
                      <div class="my-auto w-3 h-3 bg-lime-600 rounded-full"></div>
                      <div class="flex-auto">45 freelancer</div>
                    </div>
                    <img loading="lazy"
                      srcSet="https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=100 100w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=200 200w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=400 400w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=800 800w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=1200 1200w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=1600 1600w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89&width=2000 2000w, https://cdn.builder.io/api/v1/image/assets/TEMP/1fb340996da9f299f9233acfb501c251782fcac71bd39e51b1cb3f9384b66688?apiKey=023108a9c99043f18acff792c7e6bb89"
                      class="mt-2.5 max-w-full aspect-[3.23] w-[116px]" />
                  </div>
                  <img loading="lazy"
                    srcSet="https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=100 100w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=200 200w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=400 400w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=800 800w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=1200 1200w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=1600 1600w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89&width=2000 2000w, https://cdn.builder.io/api/v1/image/assets/TEMP/6839c253354f236fbfcf67fd275938cc748419b6ee20ad5356d5b0ffa9c7f84c?apiKey=023108a9c99043f18acff792c7e6bb89"
                    class="aspect-[0.99] w-[95px]" />
                </div>
              </div>
            </div>
          </div>
          <div class="flex flex-col ml-5 w-[57%] mt-4 max-md:ml-0 max-md:w-full">
            <GoogleMap />
          </div>
        </div>
      </div>
      <div
        class="flex flex-col items-center px-16 pt-7 pb-4 w-full text-lg font-bold leading-5 text-center whitespace-nowrap text-white text-opacity-90 max-md:px-5 max-md:max-w-full">
        <div class="justify-center px-9 py-3 bg-weather-primary shadow-sm rounded-[30px] max-md:px-5">
          View more
        </div>
      </div>
    </div>
    <div
      class="flex flex-col self-stretch px-20 pt-8 pb-12 mt-12 w-full text-lg leading-7 bg-white text-neutral-800 max-md:px-5 max-md:mt-10 max-md:max-w-full">
      <div class="self-center text-4xl font-medium leading-10 text-zinc-900">
        Category
      </div>
      <div class="self-center mt-3 max-md:max-w-full">
        Learn from Industry Experts and Enhance Your Skills.
      </div>
      <div class="row justify-center max-md:flex-wrap max-md:mt-10 max-md:mr-2.5 max-md:max-w-full">
        <div class="col-2 m-2 px-6 py-9 bg-violet-50 rounded-2xl" v-for="(item, index) in categories" :key="index">
          <img loading="lazy" :src="item.image" class="self-center aspect-square w-[90px]" />
          <div class="mt-3">{{ item.name }}</div>
        </div>
      </div>
    </div>
    <div
      class="flex flex-col items-center px-10 mt-12 w-full max-w-[1320px] max-md:px-5 max-md:mt-10 max-md:max-w-full bg-weather-secondary">
      <div class="text-4xl font-medium mt-5 leading-10 text-zinc-900">Service</div>
      <div class="mt-3 text-lg leading-7 text-neutral-800 max-md:max-w-full">
        Learn from Industry Experts and Enhance Your Skills.
      </div>
      <div class="self-stretch mt-12 max-md:mt-10 max-md:max-w-full">
        <div class="row gap-5 justify-center m-4 max-md:flex-col max-md:gap-0">
          <div class="grid-cols-3 gap-4 ml-3 w-[30%] max-md:ml-0 max-md:w-full" v-for="(item, index) in services"
            :key="index">
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
      <div class="mt-8 w-14 h-4 bg-white rounded-xl"></div>
    </div>
    <div
      class="flex overflow-hidden relative flex-col items-start self-stretch px-20 py-12 w-full leading-[100%] min-h-[391px] max-md:px-5 max-md:mt-10 max-md:max-w-full">
      <img loading="lazy"
        srcSet="https://cdn.builder.io/api/v1/image/assets/TEMP/507330240e4cbae8d4c1f968a49853249b8a65fb6f56f4567d7f099e098d729d?apiKey=023108a9c99043f18acff792c7e6bb89&width=100 100w, https://cdn.builder.io/api/v1/image/assets/TEMP/507330240e4cbae8d4c1f968a49853249b8a65fb6f56f4567d7f099e098d729d?apiKey=023108a9c99043f18acff792c7e6bb89&width=200 200w, https://cdn.builder.io/api/v1/image/assets/TEMP/507330240e4cbae8d4c1f968a49853249b8a65fb6f56f4567d7f099e098d729d?apiKey=023108a9c99043f18acff792c7e6bb89&width=400 400w, https://cdn.builder.io/api/v1/image/assets/TEMP/507330240e4cbae8d4c1f968a49853249b8a65fb6f56f4567d7f099e098d729d?apiKey=023108a9c99043f18acff792c7e6bb89&width=800 800w, https://cdn.builder.io/api/v1/image/assets/TEMP/507330240e4cbae8d4c1f968a49853249b8a65fb6f56f4567d7f099e098d729d?apiKey=023108a9c99043f18acff792c7e6bb89&width=1200 1200w, https://cdn.builder.io/api/v1/image/assets/TEMP/507330240e4cbae8d4c1f968a49853249b8a65fb6f56f4567d7f099e098d729d?apiKey=023108a9c99043f18acff792c7e6bb89&width=1600 1600w, https://cdn.builder.io/api/v1/image/assets/TEMP/507330240e4cbae8d4c1f968a49853249b8a65fb6f56f4567d7f099e098d729d?apiKey=023108a9c99043f18acff792c7e6bb89&width=2000 2000w, https://cdn.builder.io/api/v1/image/assets/TEMP/507330240e4cbae8d4c1f968a49853249b8a65fb6f56f4567d7f099e098d729d?apiKey=023108a9c99043f18acff792c7e6bb89"
        class="object-cover absolute inset-0 size-full" />
      <div class="relative mt-12 ml-4 text-5xl font-medium text-white max-md:mt-10 max-md:max-w-full max-md:text-4xl">
        Special Offer
      </div>
      <div class="relative mt-4 ml-4 text-2xl font-semibold text-stone-300 w-[760px] max-md:max-w-full">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.
      </div>
      <div
        class="relative justify-center px-10 py-3 mt-7 mb-12 ml-4 text-lg font-bold text-center whitespace-nowrap bg-weather-primary shadow-sm rounded-[30px] text-white text-opacity-90 max-md:px-5 max-md:mb-10 max-md:ml-2.5">
        Book Now
      </div>
    </div>
    <div
      class="flex flex-col self-stretch px-16 pt-8 pb-12 mt-12 w-full bg-white max-md:px-5 max-md:mt-10 max-md:max-w-full">
      <div class="flex flex-col items-center mx-10 mb-11 max-md:mr-2.5 max-md:mb-10 max-md:max-w-full">
        <div class="text-4xl font-medium leading-10 text-zinc-900">
          Testimonial
        </div>
        <div class="mt-3 text-lg leading-7 text-neutral-800 max-md:max-w-full">
          Learn from Industry Experts and Enhance Your Skills.
        </div>
        <div class="self-stretch mt-12 max-md:mt-10 max-md:max-w-full">
          <div class="flex gap-5 max-md:flex-col max-md:gap-0 max-md:">
            <div class="flex flex-col w-[33%] max-md:ml-0 max-md:w-full" v-for="(item, index) in testimonials"
              :key="index">
              <div class="flex flex-col grow pt-9 max-md:mt-10">
                <div class="flex flex-col items-center px-7 pb-8 rounded-3xl bg-neutral-100 max-md:px-5">
                  <div class="flex z-10 justify-center items-center px-3 mt-0 w-24 h-24 bg-white rounded-full">
                    <img loading="lazy"
                      srcSet="https://cdn.builder.io/api/v1/image/assets/TEMP/0c9ebdd08e2ad7af63eaa81dbc6dac6184e14f6a21f13170eeab06d0ad4acab2?apiKey=023108a9c99043f18acff792c7e6bb89&width=100 100w, https://cdn.builder.io/api/v1/image/assets/TEMP/0c9ebdd08e2ad7af63eaa81dbc6dac6184e14f6a21f13170eeab06d0ad4acab2?apiKey=023108a9c99043f18acff792c7e6bb89&width=200 200w, https://cdn.builder.io/api/v1/image/assets/TEMP/0c9ebdd08e2ad7af63eaa81dbc6dac6184e14f6a21f13170eeab06d0ad4acab2?apiKey=023108a9c99043f18acff792c7e6bb89&width=400 400w, https://cdn.builder.io/api/v1/image/assets/TEMP/0c9ebdd08e2ad7af63eaa81dbc6dac6184e14f6a21f13170eeab06d0ad4acab2?apiKey=023108a9c99043f18acff792c7e6bb89&width=800 800w, https://cdn.builder.io/api/v1/image/assets/TEMP/0c9ebdd08e2ad7af63eaa81dbc6dac6184e14f6a21f13170eeab06d0ad4acab2?apiKey=023108a9c99043f18acff792c7e6bb89&width=1200 1200w, https://cdn.builder.io/api/v1/image/assets/TEMP/0c9ebdd08e2ad7af63eaa81dbc6dac6184e14f6a21f13170eeab06d0ad4acab2?apiKey=023108a9c99043f18acff792c7e6bb89&width=1600 1600w, https://cdn.builder.io/api/v1/image/assets/TEMP/0c9ebdd08e2ad7af63eaa81dbc6dac6184e14f6a21f13170eeab06d0ad4acab2?apiKey=023108a9c99043f18acff792c7e6bb89&width=2000 2000w, https://cdn.builder.io/api/v1/image/assets/TEMP/0c9ebdd08e2ad7af63eaa81dbc6dac6184e14f6a21f13170eeab06d0ad4acab2?apiKey=023108a9c99043f18acff792c7e6bb89"
                      class="w-full rounded-full aspect-[0.99]" />
                    <img loading="lazy" :src="item.image" class="w-full rounded-full aspect-[0.99]" />
                  </div>
                  <div class="mt-2.5 text-2xl font-semibold leading-5 text-center whitespace-nowrap text-violet-950">
                    {{ item.name }}
                  </div>
                  <div class="mt-3.5 text-lg font-bold leading-5 text-center whitespace-nowrap text-zinc-500">
                    {{ item.title }}
                  </div>
                  <div class="self-stretch mt-7 text-lg leading-8 text-slate-500">
                    {{ item.words }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-8 w-14 h-4 bg-white rounded-xl"></div>
      </div>
    </div>
    <Footer />
  </div>
</template>
<script>
import Header from '@/components/partials/HeaderSection.vue'
import Footer from '@/components/partials/FooterSection.vue'
import GoogleMap from '../partials/GoogleMap.vue'

export default {
  components: {
    Header,
    Footer,
    GoogleMap
  },

  data() {
    return {
      activeTab: 'customer',

      backgroundImage:
        "https://cdn.builder.io/api/v1/image/assets/TEMP/2782abe7edcf3748866ad2222e8f2c67e9d7f1fe66189de1ce41acf4195e66cb?apiKey=023108a9c99043f18acff792c7e6bb89",

      // ✅ STATIC CATEGORY DATA
      categories: [
        {
          name: "Photography",
          image: "https://cdn.pixabay.com/photo/2016/11/29/05/45/adult-1868750_1280.jpg"
        },
        {
          name: "Makeup Artist",
          image: "https://cdn.pixabay.com/photo/2017/08/01/08/29/people-2563491_1280.jpg"
        },
        {
          name: "Fashion Stylist",
          image: "https://cdn.pixabay.com/photo/2017/06/26/02/47/man-2442565_1280.jpg"
        },
        {
          name: "Hair Stylist",
          image: "https://cdn.pixabay.com/photo/2016/03/27/07/08/hairdresser-1283820_1280.jpg"
        },
        {
          name: "Event Planner",
          image: "https://cdn.pixabay.com/photo/2017/08/06/11/30/wedding-2595862_1280.jpg"
        },
        {
          name: "Personal Trainer",
          image: "https://cdn.pixabay.com/photo/2016/11/21/15/46/adult-1846428_1280.jpg"
        }
      ],

      // ✅ STATIC SERVICES DATA (same structure as API)
      services: [
        {
          name: "Wedding Photography",
          image: "https://cdn.pixabay.com/photo/2016/11/29/05/45/adult-1868750_1280.jpg",
          description: "<p>Professional wedding photography service with premium quality coverage.</p>",
          price: 500,
          offer_price: 350
        },
        {
          name: "Fashion Shoot",
          image: "https://cdn.pixabay.com/photo/2017/06/26/02/47/man-2442565_1280.jpg",
          description: "<p>Creative fashion photography for models and brands.</p>",
          price: 400,
          offer_price: 280
        },
        {
          name: "Makeup Service",
          image: "https://cdn.pixabay.com/photo/2017/08/01/08/29/people-2563491_1280.jpg",
          description: "<p>Professional makeup for wedding and special events.</p>",
          price: 200,
          offer_price: 150
        },
        {
          name: "Event Coverage",
          image: "https://cdn.pixabay.com/photo/2017/08/06/11/30/wedding-2595862_1280.jpg",
          description: "<p>Complete event photography and videography service.</p>",
          price: 600,
          offer_price: 450
        }
      ],

      // ✅ STATIC TESTIMONIAL DATA
      testimonials: [
        {
          name: "Priya Sharma",
          title: "Happy Client",
          words: "Amazing service and very professional freelancer. Highly recommended!",
          image: "https://randomuser.me/api/portraits/women/1.jpg"
        },
        {
          name: "Rahul Patel",
          title: "Customer",
          words: "Booking process was smooth and service quality was excellent.",
          image: "https://randomuser.me/api/portraits/men/2.jpg"
        },
        {
          name: "Neha Verma",
          title: "Fashion Influencer",
          words: "Great experience working with talented professionals.",
          image: "https://randomuser.me/api/portraits/women/3.jpg"
        }
      ],

      // your existing data preserved
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

  methods: {
    cleanHtml(html) {
      return html.replace(/<[^>]+>/g, '')
    }
  }
}
</script>
