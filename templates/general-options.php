<div class="options_group show_if_simple_subscription show_if_variable_subscription acws-general-wrapper ">
    <label for="">Subscripton Price (₹)</label>
    <?php global $post_id ?>
    <div class="acws-sub-div1">
        <input type="text" placeholder="eg.5.90"
            value="<?php echo get_post_meta($post_id, '_subscription_price', true) ?>"
            class="acws-subscriptionPrice-inputs" name="subscription_price">
        <select class="acws-subscriptionPrice-inputs" name="subscription_every">

            <option value="every" <?php echo get_post_meta($post_id, '_subscription_every', true) === 'every' ? 'selected' : '' ?>>every</option>
            <option value="every 2nd" <?php echo get_post_meta($post_id, '_subscription_every', true) === 'every 2nd' ? 'selected' : '' ?>>every 2nd</option>
            <option value="every 3nd" <?php echo get_post_meta($post_id, '_subscription_every', true) === 'every 3nd' ? 'selected' : '' ?>>every 3nd</option>
            <option value="every 4nd" <?php echo get_post_meta($post_id, '_subscription_every', true) === 'every 4nd' ? 'selected' : '' ?>>every 4nd</option>
            <option value="every 5nd" <?php echo get_post_meta($post_id, '_subscription_every', true) === 'every 5nd' ? 'selected' : '' ?>>every 5nd</option>
            <option value="every 6nd" <?php echo get_post_meta($post_id, '_subscription_every', true) === 'every 6nd' ? 'selected' : '' ?>>every 6nd</option>

        </select>
        <select class="acws-subscriptionPrice-inputs" name="subscription_calenderUnit">
            <option value="day" <?php echo get_post_meta($post_id, '_subscription_calendarUnit', true) === 'day' ? 'selected' : '' ?>>day</option>
            <option value="week" <?php echo get_post_meta($post_id, '_subscription_calendarUnit', true) === 'week' ? 'selected' : '' ?>>week</option>
            <option value="month" <?php echo get_post_meta($post_id, '_subscription_calendarUnit', true) === 'month' ? 'selected' : '' ?>>month</option>
            <option value="year" <?php echo get_post_meta($post_id, '_subscription_calendarUnit', true) === 'year' ? 'selected' : '' ?>>year</option>
        </select>
    </div>
    <div class="acws-sub-div2">
        <label for="">Expire after</label>
        <select class="acws-expire-input" name="subscription_expire">
            <option value="Never Expire" <?php echo get_post_meta($post_id, '_subscription_expire', true) === 'Never Expire' ? 'selected' : '' ?>>Never Expire</option>
            <option value="1 week" <?php echo get_post_meta($post_id, '_subscription_expire', true) === '1 week' ? 'selected' : '' ?>>1 week</option>
            <?php
            for ($i = 2; $i < 53; $i++) { ?>
                <option value="<?php echo "$i weeks" ?>" <?php echo get_post_meta($post_id, '_subscription_expire', true) === "$i weeks" ? 'selected' : '' ?>>
                    <?php echo "$i weeks" ?></option>
            <?php } ?>

        </select>
    </div>
    <div class="acws-signup-div ">
        <label for="">Sign-up fee (₹)</label>
        <input type="text" value="<?php echo get_post_meta($post_id, '_subscription_SignUpFee', true) ?>"
            class="acws-expire-input" name="subscription_signupFee">
    </div>
    <div class="acws-freeTrial-div ">
        <label for="">Free trial</label>
        <div class="acws-free-div ">

            <input type="text" class="acws-free-input"
                value="<?php echo get_post_meta($post_id, '_subscription_FreeTrial', true) ?>"
                name="subscription_FreeTiral">
            <select class="acws-free-input" name="subscription_Trial_calenderUnit">
                <option value="days">days</option>
                <option value="weeks">weeks</option>
                <option value="months">months</option>
                <option value="year">year</option>
            </select>
        </div>
    </div>
    <div class="acws-sub-div2 ">
        <label for="">Synchronise renewals</label>
        <select class="acws-expire-input" name="subscription_Sync_renewal">
            <option value="days" <?php echo get_post_meta($post_id, '_subscription_syncRenewal', true) === 'days' ? 'selected' : '' ?>>days</option>
            <option value="weeks" <?php echo get_post_meta($post_id, '_subscription_syncRenewal', true) === 'weeks' ? 'selected' : '' ?>>weeks</option>
            <option value="months" <?php echo get_post_meta($post_id, '_subscription_syncRenewal', true) === 'months' ? 'selected' : '' ?>>months</option>
            <option value="year" <?php echo get_post_meta($post_id,'_subscription_syncRenewal',true) === 'year'? 'selected':'' ?>>year</option>
        </select>
    </div>
    <div class="acws-sales-div ">
        <label for="">Sale price (₹)</label>
        <input type="text" class="acws-expire-input" value="<?php echo get_post_meta($post_id, '_subscription_SalePrice', true)?> " name="subscription_sale_price">
        <p>every week <a href="" id="schedule-element" class="scheduled">Schedule</a></p>
    </div>
    <div class="acws-salesDates-div" id="elementTobe">
        <label for="">Sale price dates</label>
        <input type="date" class="acws-expire-input" value="<?php echo get_post_meta($post_id, '_subscription_salePrice_before', true)?>" name="subscription_salePrice_before">
        <div class="acws-saleDate-div">

            <input type="date" class="acws-expire-input" name="subscription_salePrice_after" value="<?php echo get_post_meta($post_id, '_subscription_salePrice_after', true)?>">
        </div>
        <a href="" id="cancel-schedule">Cancel</a>
    </div>

</div>