import{e as w,v,A as x,l as p,o as y,k as f,a as d,g as l,D as r,b as e,h as m,I as u,n as b,B as h,d as g,J as _,t as C,w as $}from"./app-820371dd.js";const k={class:"fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50","scroll-region":""},S=e("div",{class:"absolute inset-0 bg-gray-500 opacity-75"},null,-1),B=[S],M={__name:"Modal",props:{show:{type:Boolean,default:!1},maxWidth:{type:String,default:"2xl"},closeable:{type:Boolean,default:!0}},emits:["close"],setup(t,{emit:n}){const s=t;w(()=>s.show,()=>{s.show?document.body.style.overflow="hidden":document.body.style.overflow=null});const o=()=>{s.closeable&&n("close")},a=c=>{c.key==="Escape"&&s.show&&o()};v(()=>document.addEventListener("keydown",a)),x(()=>{document.removeEventListener("keydown",a),document.body.style.overflow=null});const i=p(()=>({sm:"sm:max-w-sm",md:"sm:max-w-md",lg:"sm:max-w-lg",xl:"sm:max-w-xl","2xl":"sm:max-w-2xl"})[s.maxWidth]);return(c,z)=>(y(),f(_,{to:"body"},[d(m,{"leave-active-class":"duration-200"},{default:l(()=>[r(e("div",k,[d(m,{"enter-active-class":"ease-out duration-300","enter-from-class":"opacity-0","enter-to-class":"opacity-100","leave-active-class":"ease-in duration-200","leave-from-class":"opacity-100","leave-to-class":"opacity-0"},{default:l(()=>[r(e("div",{class:"fixed inset-0 transform transition-all",onClick:o},B,512),[[u,t.show]])]),_:1}),d(m,{"enter-active-class":"ease-out duration-300","enter-from-class":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95","enter-to-class":"opacity-100 translate-y-0 sm:scale-100","leave-active-class":"ease-in duration-200","leave-from-class":"opacity-100 translate-y-0 sm:scale-100","leave-to-class":"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"},{default:l(()=>[r(e("div",{class:b(["mb-6 bg-white rounded-xl overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto",i.value])},[t.show?h(c.$slots,"default",{key:0}):g("",!0)],2),[[u,t.show]])]),_:3})],512),[[u,t.show]])]),_:3})]))}},W={class:"p-4 sm:p-6"},E={class:"text-lg font-medium text-basic"},D={class:"mt-4 text-gray-600"},N={class:"flex flex-row justify-end px-6 py-4 bg-card text-right gap-4"},V=e("button",{type:"submit",class:"primary-button"}," Guardar ",-1),T={__name:"FormModal",props:{show:{type:Boolean,default:!1},maxWidth:{type:String,default:"2xl"},closeable:{type:Boolean,default:!0},title:{type:String,default:"Modal"}},emits:["close","onSubmit","onCancel"],setup(t,{emit:n}){const s=()=>{n("close")};return(o,a)=>(y(),f(M,{show:t.show,"max-width":t.maxWidth,closeable:t.closeable,onClose:s},{default:l(()=>[e("form",{onSubmit:a[1]||(a[1]=$(i=>o.$emit("onSubmit"),["prevent"]))},[e("div",W,[e("div",E,C(t.title),1),e("div",D,[h(o.$slots,"default")])]),e("div",N,[e("button",{class:"secondary-button",type:"button",onClick:a[0]||(a[0]=i=>o.$emit("onCancel"))}," Cancelar "),V])],32)]),_:3},8,["show","max-width","closeable"]))}};export{T as _};
