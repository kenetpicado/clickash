import{o as d,g as f,e as T,B as v,b as y,n as O,J as B,I as g,z as _,M as l}from"./app-37ee622e.js";const b=s=>{typeof s.remove<"u"?s.remove():s.parentNode.removeChild(s)};class C{constructor(t,e){this.startedAt=Date.now(),this.callback=t,this.delay=e,this.timer=setTimeout(t,e)}pause(){this.stop(),this.delay-=Date.now()-this.startedAt}resume(){this.stop(),this.startedAt=Date.now(),this.timer=setTimeout(this.callback,this.delay)}stop(){clearTimeout(this.timer)}}const a={TOP_RIGHT:"top-right",TOP:"top",TOP_LEFT:"top-left",BOTTOM_RIGHT:"bottom-right",BOTTOM:"bottom",BOTTOM_LEFT:"bottom-left"},c=Object.freeze(a);function h(s,t,e){let o=null;switch(s){case a.TOP:case a.TOP_RIGHT:case a.TOP_LEFT:o=t;break;case a.BOTTOM:case a.BOTTOM_RIGHT:case a.BOTTOM_LEFT:o=e;break}return o}class w{constructor(){this.queue={}}$on(t,e){this.queue[t]=this.queue[t]||[],this.queue[t].push(e)}$off(t,e){if(this.queue[t]){for(var o=0;o<this.queue[t].length;o++)if(this.queue[t][o]===e){this.queue[t].splice(o,1);break}}}$emit(t,e){this.queue[t]&&this.queue[t].forEach(function(o){o(e)})}}const u=new w;const q=(s,t)=>{const e=s.__vccOpts||s;for(const[o,n]of t)e[o]=n;return e},E={name:"toast",props:{message:{type:String,required:!0},type:{type:String,default:"default"},position:{type:String,default:c.BOTTOM_RIGHT,validator(s){return Object.values(c).includes(s)}},maxToasts:{type:[Number,Boolean],default:!1},duration:{type:[Number,Boolean],default:4e3},dismissible:{type:Boolean,default:!0},queue:{type:Boolean,default:!1},pauseOnHover:{type:Boolean,default:!0},useDefaultCss:{type:Boolean,default:!0},onClose:{type:Function,default:()=>{}},onClick:{type:Function,default:()=>{}}},data(){return{isActive:!1,parentTop:null,parentBottom:null,isHovered:!1,timer:null}},beforeMount(){this.createParents(),this.setDefaultCss(),this.setupContainer()},mounted(){this.showNotice(),u.$on("toast-clear",this.close)},methods:{createParents(){this.parentTop=document.querySelector(".c-toast-container--top"),this.parentBottom=document.querySelector(".c-toast-container--bottom"),!(this.parentTop&&this.parentBottom)&&(this.parentTop||(this.parentTop=document.createElement("div"),this.parentTop.className="c-toast-container c-toast-container--top"),this.parentBottom||(this.parentBottom=document.createElement("div"),this.parentBottom.className="c-toast-container c-toast-container--bottom"))},setDefaultCss(){const s=this.useDefaultCss?"add":"remove";this.parentTop.classList[s]("v--default-css"),this.parentBottom.classList[s]("v--default-css")},setupContainer(){const s=document.body;s.appendChild(this.parentTop),s.appendChild(this.parentBottom)},shouldQueue(){return!this.queue&&this.maxToasts===!1?!1:this.maxToasts!==!1?this.maxToasts<=this.parentTop.childElementCount+this.parentBottom.childElementCount:this.parentTop.childElementCount>0||this.parentBottom.childElementCount>0},showNotice(){if(this.shouldQueue()){this.queueTimer=setTimeout(this.showNotice,250);return}this.correctParent.insertAdjacentElement("afterbegin",this.$el),this.isActive=!0,this.timer=this.duration!==!1?new C(this.close,this.duration):null},click(){this.onClick.apply(null,arguments),this.dismissible&&this.close()},toggleTimer(s){this.timer&&this.pauseOnHover&&(s?this.timer.pause():this.timer.resume())},stopTimer(){this.timer&&this.timer.stop(),clearTimeout(this.queueTimer)},close(){this.stopTimer(),this.isActive=!1,setTimeout(()=>{this.onClose.apply(null,arguments),b(this.$el)},150)}},computed:{correctParent(){return h(this.position,this.parentTop,this.parentBottom)},transition(){return h(this.position,{enter:"fadeInDown",leave:"fadeOut"},{enter:"fadeInUp",leave:"fadeOut"})}},beforeUnmount(){u.$off("toast-clear",this.close)}},P=["innerHTML"];function k(s,t,e,o,n,i){return d(),f(g,{"enter-active-class":i.transition.enter,"leave-active-class":i.transition.leave},{default:T(()=>[v(y("div",{class:O(["c-toast",`c-toast--${e.type}`,`c-toast--${e.position}`]),onMouseover:t[0]||(t[0]=r=>i.toggleTimer(!0)),onMouseleave:t[1]||(t[1]=r=>i.toggleTimer(!1)),onClick:t[2]||(t[2]=(...r)=>i.click&&i.click(...r)),role:"alert",innerHTML:e.message},null,42,P),[[B,n.isActive]])]),_:1},8,["enter-active-class","leave-active-class"])}const m=q(E,[["render",k]]),x=()=>typeof document<"u"&&document.createElement("div"),M=(s,{props:t,children:e,element:o,app:n}={})=>{let i=o||x(),r=_(s,t,e);return n&&n._context&&(r.appContext=n._context),l(r,i),{vNode:r,destroy:()=>{i&&l(null,i),i=null,r=null},el:i}},p=(s={})=>({show(t,e={}){let o={message:t,...e};return M(m,{props:{...s,...o}})},clear(){u.$emit("toast-clear")},success(t,e={}){return e.type="success",this.show(t,e)},error(t,e={}){return e.type="error",this.show(t,e)},info(t,e={}){return e.type="info",this.show(t,e)},warning(t,e={}){return e.type="warning",this.show(t,e)}}),N=(s,t={})=>{let e=p(t);s.$toast=e,s.config.globalProperties.$toast=e};m.install=N;const A=p({position:"bottom",duration:2e3,maxToasts:2});export{A as t};
