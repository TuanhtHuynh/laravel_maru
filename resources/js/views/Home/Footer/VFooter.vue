<template>
  <div class="footer">
    <div class="footer__column">
      <div class="footer__headers">
        Công ty
      </div>
      <ul class="footer__links">
        <li class="footer__item">
          <router-link
            class="footer__link"
            to="/gioi-thieu"
          >Giới thiệu</router-link>
        </li>
        <li class="footer__item">
          <router-link
            class="footer__link"
            to="/viec-lam"
          >Việc làm</router-link>
        </li>
        <li class="footer__item">
          <router-link
            class="footer__link"
            to="/lien-he"
          >Liên hệ</router-link>
        </li>
      </ul>
    </div>
    <div class="footer__column">
      <div class="footer__headers">
        Tham gia trên
      </div>
      <ul class="footer__links">
        <li class="footer__item">
          <a
            class="footer__link"
            href="https://www.facebook.com"
          >Facebook</a>
        </li>
        <li class="footer__item">
          <a
            class="footer__link"
            href="https://www.youtube.com"
          >youtube.com</a>
        </li>
      </ul>
    </div>
    <div class="footer__cef__column">
      <div class="footer__headers">
        Giấy phép
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "v-footer",
};
</script>

<style>
.footer {
  background: #fff;
  height: 210px;
  max-width: 1170px;
  margin: 0 auto;
  padding: 0 10px;
  overflow: hidden;
  display: flex;
  flex-wrap: wrap;

  overflow: hidden;
}
.footer__column {
  flex-basis: 33.3%;
}
.footer__cef__column {
  flex-basis: 33.3%;
}
.footer__headers {
  font-weight: 700;
  font-size: 12px;
  width: 100%;
  color: #aaa;
  border-bottom: 1px solid #eee;
  margin-bottom: 5px;
}
.footer__links {
  list-style: none;
  margin: 0;
  padding: 0;
  color: #3399d2;
  width: 100%;
  font-size: 12px;
}
.footer__link:hover {
  color: #333;
}
@media screen and (max-width: 769px) {
  .footer {
    justify-content: space-between;
    width: 50%;
  }
  .footer__column {
    flex-basis: 50%;
  }
  .footer__cef__column {
    display: none;
  }
}
</style>