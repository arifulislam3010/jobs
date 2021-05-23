<template>
    <ul class="icons-div mb-5">
        <li class="icon-item icon_1">
            
            <nuxt-link to="/list/important-embassy" class="see-more"><img src="../../../assets/icon/icon_1.png" /></nuxt-link>
            <nuxt-link to="/list/important-embassy" class="see-more"><span>গুরুত্বপূর্ণ এমব্যাসি</span></nuxt-link>
        </li>
        <li class="icon-item icon_2">
            <nuxt-link to="/page/questions" class="see-more"><img src="../../../assets/icon/icon_2.png" /></nuxt-link>
            
            <nuxt-link to="/page/questions" class="see-more"><span>সচরাচর জিজ্ঞাসা</span></nuxt-link>
        </li>
        <li class="icon-item icon_3">
            
             <nuxt-link to="/অভিযোগ-প্রতিকার-সংক্রান্ত-তথ্য" class="see-more"><img src="../../../assets/icon/icon_3.png" /></nuxt-link>
            <nuxt-link to="/অভিযোগ-প্রতিকার-সংক্রান্ত-তথ্য" class="see-more"><span>অভিযোগ প্রতিকার সংক্রান্ত তথ্য</span></nuxt-link>
        </li>
        <li class="icon-item icon_4">
            
            <nuxt-link to="/opinion" class="see-more"><img src="../../../assets/icon/icon_4.png" /></nuxt-link>
            <nuxt-link to="/opinion" class="see-more"><span>মতামত</span></nuxt-link>
        </li>
        <li class="icon-item icon_5">
            
            <nuxt-link to="/সিটিজেন-চার্টার" class="see-more"><img src="../../../assets/icon/icon_5.png" /></nuxt-link>
            <nuxt-link to="/সিটিজেন-চার্টার" class="see-more"><span>সিটিজেন চার্টার</span></nuxt-link>
        </li>
    </ul>
</template>
<style scoped>
.icons-div { list-style: none; font-size: 12px; }
.icon-item { position: relative; display: inline-block; width: 19%; text-align: center; border-right: 1px solid #cccccc; height: auto; padding: 0 10px; }
.icon-item:last-child { border-right-width: 0px }
.icon-item img { position: relative; display: block; margin: auto; margin-bottom: 15px; }
.icon-item.icon_1 img, .icon-item.icon_3 img, .icon-item.icon_4 img { width: 100px; }
.icon-item.icon_2 img { width: 140px; }
.icon-item.icon_5 img { width: 80px; }
@media (max-width: 1024px){
    .icon-item.icon_3 img { width: 80px; }
}
@media (max-width: 768px){
    .icon-item.icon_1 img, .icon-item.icon_4 img { width: 90px; }
    .icon-item.icon_2 img { width: 100px; }
    .icon-item.icon_3 img, .icon-item.icon_5 img { width: 70px; }
}
@media (max-width: 425px){
    .icon-item.icon_1 img { width: 40px; }
    .icon-item.icon_2 img { width: 58px; }
    .icon-item.icon_3 img { width: 30px; }
    .icon-item.icon_4 img { width: 60px; padding-right: 10px; }
    .icon-item.icon_5 img { width: 30px; }
    .icons-div { padding: 0; }
}
</style>