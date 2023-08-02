<div class="subscribe md:flex md:justify-between px-10  md:items-center flex-wrap">
    <div class="left-side md:flex justify-space-between  md:items-center">
        <img src="/images/email-logo.jpg" alt="">
        <h4>Join now and get 10% <br> off your next purchase!</h4>
    </div>
    <div class="right-side md:flex  md:items-center flex-wrap">
        <h4 class="px-20 subscribe-text-grey">Subscribe to the weekly newsletter for all <br>
            the <br>
            latest updates
        </h4>
        <!-- <form action="" method="post" class="flex">
            @csrf
            <input class="subscribe-input" type="email" name="email" placeholder="your email address..." required>
            <button class="subscribe-btn" type="submit">Submit</button>
        </form> -->

        <form method="POST" action="/newsletter" class="flex">
                        @csrf

                        <div class="">

                            <div>
                                <input id="email"
                                       name="email"
                                       type="text"
                                       placeholder="Your email address"
                                       class="subscribe-input">

                                @error('email')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit"
                                class="subscribe-btn"
                        >
                            Subscribe
                        </button>
                    </form>

    </div>
</div>