<template>
  <div class="readmore">
      <div v-show="!toggled">
        <slot name="excerpt"></slot>
      </div>
      <div v-show="toggled">
        <slot name="content"></slot>
      </div>
      <a href="javascript:void(0)" @click="toggle" :class="linkClass">
          {{ toggled ? lessText : moreText }}
      </a>
  </div>
</template>

<script>
export default {
  name: 'read-more',
  props: {
    moreText: { type: String, default: 'Read more' },
    lessText: { type: String, default: 'Read less' },
    linkClass: { type: String }
  },
  data() {
    return { toggled: false };
  },
  mounted: function() {
    this.$store.subscribe((mutation, state) => {
      if(mutation.type === 'slidePrev' || mutation.type === 'slideNext' || mutation.type === 'slideReset'){
          this.close();
      }
    });
  },
  methods: {
    beforeEnter: function(el) {
      el.style.height = '0';
    },
    enter: function(el) {
      el.style.height = el.scrollHeight + 'px';
    },
    beforeLeave: function(el) {
      el.style.height = el.scrollHeight + 'px';
    },
    leave: function(el) {
      el.style.height = '0';
    },
    toggle(state) { 
      this.toggled = !this.toggled; 
    },
    close() { 
      this.toggled = false;
    }
  },
};
</script>