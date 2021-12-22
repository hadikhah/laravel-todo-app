<template>
  <Head title="Email Verification"/>

  <div class="flex flex-col overflow-y-auto md:flex-row">
    <div class="h-32 md:h-auto md:w-1/2">
      <img aria-hidden="true" class="object-cover w-full h-full"
           src="/images/forgot-password-office.jpeg" alt="Office"/>
    </div>
    <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
      <div class="w-full">
        <h1 class="mb-4 font-semibold text-gray-700">
          Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we
          just emailed to you? If you didn't receive the email, we will gladly send you another.
        </h1>

        <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent">
          A new verification link has been sent to the email address you provided during registration.
        </div>

        <form @submit.prevent="submit">
          <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Resend Verification Email
          </BreezeButton>

          <Link :href="route('logout')" method="post" as="button"
                class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-gray-600 border border-transparent rounded-lg  active:bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring">
              Log Out
          </Link>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
  layout: BreezeGuestLayout,

  components: {
    BreezeButton,
    Head,
    Link,
  },

  props: {
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form()
    }
  },

  methods: {
    submit() {
      this.form.post(this.route('verification.send'))
    },
  },

  computed: {
    verificationLinkSent() {
      return this.status === 'verification-link-sent';
    }
  }
}
</script>
