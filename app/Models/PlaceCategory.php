<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PlaceCategory extends Model
{
    protected $fillable = ['name', 'label', 'is_active'];

    protected $searchable = [
        'name'
    ];

    public function scopeSearching($q)
    {
        if (request('search')) {
            $q->where(function ($query) {
                foreach ($this->searchable as $key => $value) {
                    $query->orWhere($value, 'LIKE', '%' . request('search') . '%');
                }
            });
        }
        return $q;
    }

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }

    public function getMetaDescription($city)
    {
        $businessMetaDescription = [
            "Discover top ___plural_category___ in ___city___: browse ratings, read reviews, and find contact details to connect with the best local ___category___ near you.",
            "Looking for ___category___ in ___city___? Explore our curated list of the finest ___plural_category___, complete with reviews, ratings & easy booking.",
            "Browse ___plural_category___ in ___city___—compare prices, check reviews, and get directions to your next favorite ___category___ today.",
            "Find top-rated ___category___ in ___city___. View menus, galleries, user ratings, and exclusive offers for the best local ___category___ today.",
            "Explore the best ___plural_category___ in ___city___—from budget-friendly spots to premium experiences. Read real reviews and book your next ___category___.",
            "Search ___category___ in ___city___: compare services, check availability, and get contact info for leading local ___plural_category___ in one place.",
            "Need a ___category___ in ___city___? Our directory lists trusted ___plural_category___, complete with verified reviews, ratings & precise location details.",
            "Browse ___plural_category___ near ___city___—see opening hours, latest deals, and top customer-rated ___category___ all in one easy-to-use directory.",
            "Unlock the best ___plural_category___ in ___city___—discover user favorites, read honest reviews, and get directions to standout ___category___ near you.",
            "Your guide to ___plural_category___ in ___city___: browse top picks, see live ratings, and book appointments with the premier ___category___ in town."
        ];
        $count = count($businessMetaDescription);
        $idx = ($this->id + strlen($city)) % $count;
        return str_replace(
            ['___plural_category___', '___category___', '___city___'],
            [Str::plural($this->label), $this->label, $city],
            $businessMetaDescription[$idx]
        );
    }

    public function getDescription($city)
    {
        $businessMetaDescription = [
            "Discover the ultimate guide to ___plural_category___ in ___city___ with our comprehensive platform designed to bring every detail about each ___category___ straight to your fingertips. Our directory compiles high-resolution images, in-depth descriptions, and real-time availability data so you can effortlessly plan your next outing. Each listing for a ___category___ in ___city___ includes genuine customer testimonials, highlighting both outstanding experiences and constructive feedback to help you make an informed choice. We update pricing, special promotions, and seasonal offers daily through direct partnerships with trusted local providers, ensuring you always have the latest deals.___||___Use our customizable filters to sort by price range, average rating, proximity to central ___city___, and amenities such as delivery options, online reservations, or exclusive VIP experiences. Our interactive map view allows you to visualize each ___category___ location, assess surrounding attractions, and calculate travel times based on current traffic conditions. You can bookmark favorite ___category___ in ___city___, share curated lists with friends, and set up personalized notifications for new openings or limited-time events. With our user-friendly interface and commitment to accuracy, discovering prime ___category___ in ___city___ has never been this seamless and enjoyable.",

            "Whether you’re searching for budget-friendly ___category___ or premium experiences in ___city___, our carefully curated collection has something to suit every taste and occasion. You can explore lists of family-friendly ___plural_category___, romantic venues, or business-oriented locations by selecting tags that align with your preferences. Each ___category___ profile features a gallery of professional photographs alongside user-uploaded images, giving you an authentic feel for the ambiance before you arrive. Read through verified reviews that detail service quality, cleanliness standards, and overall customer satisfaction to help you decide with confidence. Our platform also highlights editor’s picks and trending spots, drawing attention to notable newcomers and iconic establishments in ___city___.___||___We provide direct booking links and real-time seat availability for those ___plural_category___ that accept online reservations, so you can secure your spot instantly. Additionally, you can send inquiries, request quotes, or chat directly with business owners through our integrated messaging system. Our built-in recommendation engine learns from your past searches and ratings, suggesting new ___category___ in ___city___ that match your unique tastes and budget. With transparent pricing information and side-by-side comparisons, you can optimize your experience and discover hidden gems around every corner of this vibrant city.",

            "Stay up to date with the latest crowd-sourced feedback on ___plural_category___ in ___city___ by following our in-depth review analytics that aggregate ratings across service, ambiance, value, and staff friendliness. You can access monthly trend reports to see which ___category___ have experienced an uptick in popularity, user engagement, or exceptional feedback. Our advanced search tools allow you to filter ___plural_category___ by dietary options, accessibility features, open hours, and payment methods, making it easy to find exactly what you need at any time of day. Learn about exclusive offers and loyalty programs directly on each ___category___’s profile, with promotional codes automatically applied at checkout when available.___||___Participate in our community forums to ask questions, share tips, or post photos of your own experiences in different ___city___ neighborhoods. Organize field trips or group outings by creating collaborative itineraries that highlight multiple ___plural_category___ in ___city___ with distance and travel time clearly outlined. With automated notifications sent to your email or mobile device, you’ll be the first to know about pop-up events, limited seating tastings, or special workshops hosted by top ___plural_category___ providers. Whether you’re a long-time resident or a first-time visitor to ___city___, our comprehensive directory ensures you never miss an opportunity to explore and enjoy the local ___category___ scene to the fullest.",

            "Our platform’s dynamic comparative feature highlights similar ___category___ in ___city___ side by side, allowing you to weigh pros and cons based on price, customer ratings, and available amenities such as outdoor seating, wifi access, or private rooms. Each ___category___ listing includes a detailed breakdown of service options—like takeout, delivery, dine-in, or curbside pickup—so you can quickly determine which venues accommodate your specific needs and schedule. Explore user-generated photo galleries to see authentic perspectives on interior decor, dish presentation, or facility layouts. Our real-time chat support can answer any lingering questions about group discounts, dietary accommodations, or pet-friendly policies directly within the directory interface.___||___Save time by using our bulk booking tool for corporate events, birthday celebrations, or large gatherings, which sends automated requests to multiple ___plural_category___ providers in ___city___ and returns consolidated quotes. We also offer curated video tours and virtual walkthroughs for select ___category___, giving you an immersive preview before visiting in person. Connect your calendar to our system to receive automatic reminders and share appointment details with friends or colleagues. With our seamless payment integration, you can complete deposits, secure reservations, or purchase vouchers safely through encrypted gateways, ensuring peace of mind with every transaction.",

            "Navigate the sprawling neighborhoods of ___city___ with ease using our interactive map tool, which plots every ___category___ location and offers filters for distance, neighborhood names, or proximity to major landmarks or public transport stations. Plan multi-stop itineraries that optimize your route based on traffic patterns, estimated travel times, and user-submitted walking paths between consecutive ___plural_category___.___||___View elevation profiles and step-by-step directions whether you’re traveling by car, scooter, bicycle, or on foot. Each ___category___ map pin reveals quick info like average rating, price level, and opening hours at a glance so you can make spontaneous decisions when you’re out and about in ___city___. For travelers, our tool integrates with popular ride-sharing apps and public transit schedules, helping you estimate fare costs and departure times before you even leave home. Use the “around me” feature to discover nearby ___plural_category___ if you find yourself in an unfamiliar part of ___city___. Annotate custom notes or photos on your personal map and share them socially with friends planning their own adventures. Whether you’re exploring morning coffee spots or late-night eateries, our mapping system ensures you never miss a beat.",

            "Enjoy unparalleled access to exclusive promotions and time-limited offers from ___plural_category___ in ___city___ through our platform’s deal aggregator. We partner with local businesses to curate flash sales, seasonal menus, and loyalty incentives, all of which are prominently displayed on each ___category___ profile along with countdown timers so you know exactly how much time remains to claim a special price. Subscribe to our newsletter or enable push notifications to receive personalized deal recommendations based on your saved preferences, past bookings, and favorite ___plural_category___ categories. Benefit from early access to ticketed events, tasting sessions, or workshops hosted by renowned ___plural_category___ providers, giving you VIP treatment and priority seating.___||___Use our in-app coupon wallet to store and redeem vouchers seamlessly at checkout when you visit in person. Our community-driven rating system ensures that the best deals are always highlighted through user voting, making it easy to find bona fide savings rather than misleading advertisements. Track your savings history, view spending insights, and earn rewards points for frequent engagement, which can be redeemed for discounts on future visits to participating ___plural_category___ in ___city___. With an intuitive dashboard and transparent terms, managing your budget has never been easier.",

            "Make booking appointments or reservations for ___category___ in ___city___ effortless using our integrated scheduling system that syncs directly with provider calendars to show real-time availability. Whether you need to schedule a haircut, a dinner reservation for two, or a spa session, our platform allows you to select your preferred date, time, and any additional services with just a few clicks. Receive instant confirmations via email and SMS, along with calendar invites that automatically populate your personal devices for seamless planning.___||___Modify or cancel reservations directly through our interface without having to contact the business separately, and view our flexible cancellation policies upfront to avoid unexpected fees. For professionals offering tiered services—such as premium packages, add-on treatments, or group bookings—our scheduler displays detailed pricing breakdowns and duration estimates to help you choose the best option. Connect with business owners directly through encrypted messaging to customize your experience, ask about group accommodations, or request special arrangements for dietary restrictions. Enjoy peace of mind knowing that each ___category___ provider undergoes regular verification and follows standardized safety protocols, ensuring quality service every time you book in ___city___.",

            "Access comprehensive safety and hygiene information for every ___category___ in ___city___ to ensure peace of mind before you visit. Our platform partners with local health authorities and regulatory agencies to verify safety certifications, sanitation standards, and compliance with any ongoing public health guidelines. Each ___category___ listing displays an up-to-date safety badge that includes parameters such as daily cleaning routines, staff vaccination rates, and capacity limits. You can filter ___plural_category___ by those safety ratings, selecting only establishments that meet your personal comfort level regarding health measures.___||___Read detailed protocols for mask requirements, contactless payment options, air filtration systems, and social distancing policies to plan your visit accordingly. In addition, we provide community feedback on how strictly each ___category___ enforces safety guidelines, offering anecdotal insights into real-world practices. For international travelers or individuals with specific medical concerns, our system links seamlessly to external resources, including embassy advisories and local helplines, so you have access to official information instantly. With our robust verification process and transparent reporting, you can enjoy every ___category___ experience in ___city___ confidently and responsibly.",

            "Stay informed about seasonal highlights and community events at ___category___ in ___city___ by exploring our regularly updated event calendar that integrates local festivals, pop-up markets, and special tastings. From summer street food fairs to winter holiday markets, our platform ensures you’re aware of time-sensitive opportunities happening near your favorite ___plural_category___ spots. Subscribe to category-specific event alerts to receive notifications about chef appearances, product launches, or limited edition menu releases.___||___Engage with other community members through our event pages where attendees share tips, photos, and reviews, creating a vibrant social feed around each gathering. Add events directly to your personal calendar, invite friends via email or social media, and coordinate group meetups with tailored itineraries covering multiple ___category___ venues. Benefit from early bird registration discounts and priority access reserved exclusively for our subscribers. With multi-language support and accessibility information, our event listings cater to a diverse range of visitors to ___city___, ensuring everyone can find and participate in memorable experiences at local ___category___ establishments.",

            "Finally, join our thriving user community dedicated to exploring and rating ___category___ in ___city___ by signing up for a free account that unlocks advanced features. Customize your profile with preferences, dietary restrictions, and favorite cuisines or service styles to receive personalized recommendations that evolve with every review and booking you make. Participate in our monthly challenges and polls to earn badges and rewards for engaging with new ___category___ locations in ___city___.___||___Share your own photos, detailed reviews, and insider tips to help fellow users discover hidden gems and lesser-known spots that deserve recognition. Build collaborative group lists to showcase your top-rated ___plural_category___ or plan bar crawls, tasting tours, and spa days with friends based on collective input. Access exclusive member-only content such as in-depth articles, behind-the-scenes interviews with local experts, and video tours of top ___category___ venues. With our commitment to fostering a transparent, helpful, and engaged community, every visit to a ___category___ in ___city___ becomes an opportunity to connect, share, and experience something extraordinary together."
        ];
        $count = count($businessMetaDescription);
        $idx = ($this->id + strlen($city)) % $count;
        return str_replace(
            ['___plural_category___', '___category___', '___city___'],
            [Str::plural($this->label), $this->label, $city],
            $businessMetaDescription[$idx]
        );
    }
}
