import{j as c,o as r,c as u,b as s,t as d,n as m,d as f}from"./app-d1da7f39.js";const p={class:"w-full mb-4"},y={class:"block font-medium text-sm text-basic"},g=["type","placeholder","disabled","autofocus","required","autocomplete","value"],b={key:0,class:"text-sm text-red-600 mt-1"},k={__name:"InputForm",props:{text:{type:String,required:!0},modelValue:{type:[String,Number],required:!1},type:{type:String,default:"text"},name:{type:String,required:!1},placeholder:{type:String,default:""},disabled:{type:Boolean,default:!1},required:{type:Boolean,default:!1},autofocus:{type:Boolean,default:!1},autocomple:{type:String,default:"off"}},setup(e){const a=e,o=c(()=>a.name??n(a.text));function n(t){return t.toLowerCase().replace(/ /g,"_")}return(t,l)=>(r(),u("div",p,[s("label",y,d(e.text),1),s("input",{type:e.type,placeholder:e.placeholder,disabled:e.disabled,autofocus:e.autofocus,required:e.required,autocomplete:e.autocomple,class:m(["border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm mt-1 block w-full transition duration-300 ease-in-out",[e.disabled?"bg-gray-100":""]]),value:e.modelValue,onInput:l[0]||(l[0]=i=>t.$emit("update:modelValue",i.target.value))},null,42,g),t.$page.props.errors[o.value]?(r(),u("p",b,d(t.$page.props.errors[o.value]),1)):f("",!0)]))}};export{k as _};
