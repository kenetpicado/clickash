import{I as c,_}from"./AppLayout-454c79c4.js";import{c as p}from"./createVueComponent-48ddbecd.js";import{o as a,c as d,b as e,e as u,l as m,u as h,t as l,f as i,h as f,a as v,F as g}from"./app-e6f78d54.js";import"./IconChevronRight-769b3085.js";var x=p("info-circle","IconInfoCircle",[["path",{d:"M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0",key:"svg-0"}],["path",{d:"M12 9h.01",key:"svg-1"}],["path",{d:"M11 12h1v4h1",key:"svg-2"}]]);const b={class:"bg-white h-20 rounded-xl"},y={class:"flex items-center h-full p-4 gap-3"},I={class:"bg-indigo-50 rounded-full p-2"},k={class:"font-bold text-lg"},C={class:"text-sm text-gray-600"},N={__name:"StatCard",props:{stat:{type:Object,required:!0}},setup(t){const s=x;return(o,n)=>(a(),d("div",b,[e("div",y,[e("span",I,[(a(),u(m(t.stat.icon??h(s)),{size:"30",class:"text-indigo-600"}))]),e("div",null,[e("div",k,l(t.stat.value),1),e("div",C,l(t.stat.title),1)])])]))}},B=e("span",{class:"title"}," Overview ",-1),U={class:"grid grid-cols-4 gap-4"},S={__name:"Index",props:{users_count:{type:Number,default:0},sellers_count:{type:Number,default:0}},setup(t){const s=t,o=[{name:"Home",route:route("dashboard.users.index")}],n=[{value:s.users_count,title:"Users",icon:c},{value:s.sellers_count,title:"Sellers",icon:c}];return($,w)=>(a(),u(_,{title:"Users",breads:o},{header:i(()=>[B]),default:i(()=>[e("div",U,[(a(),d(g,null,f(n,r=>v(N,{stat:r,key:r.name},null,8,["stat"])),64))])]),_:1}))}};export{S as default};