<template>
    <div>        
        <v-btn
        elevation="2"
        @click="$emit('first')"
        >&lt;&lt;</v-btn>
        <v-btn
        elevation="2"
        @click="$emit('prev')"
        >&lt;</v-btn>
        <v-btn
        elevation="2"
        @click="$emit('next')"
        >></v-btn>
        <v-btn
        elevation="2"
        @click="$emit('last')"
        >>></v-btn>
        <v-btn
        elevation="2"
         @click="$emit('save')"
        >
            <v-icon dark>
            mdi-content-save
            </v-icon>
        </v-btn>
        <v-btn
          elevation="2"
          @click="$emit('remove')"
        >
          <v-icon dark>
            mdi-delete
          </v-icon>
        </v-btn>
    </div>
</template>

<script>

export default {
    name: 'BotoneraAbm',
    
}

</script>