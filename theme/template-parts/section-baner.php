<v-baner inline-template>
  <div class="checkbox-wrapper" @click="check">
    <div :class="{ checkbox: true, checked: checked }"></div>
    <div class="title">{{ title }}</div>
  </div>
</v-baner>
