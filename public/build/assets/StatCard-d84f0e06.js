import{c}from"./IconUser-b8250f54.js";import{o as s,c as n,b as t,j as r,z as i,u as l,t as a}from"./app-c128e984.js";var d=c("info-circle","IconInfoCircle",[["path",{d:"M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0",key:"svg-0"}],["path",{d:"M12 9h.01",key:"svg-1"}],["path",{d:"M11 12h1v4h1",key:"svg-2"}]]);const h={class:"bg-card h-20 rounded-xl"},_={class:"flex items-center h-full p-4 gap-3"},p={class:"bg-primary rounded-full p-2"},m={class:"text-gray-600"},u={class:"font-bold text-lg"},v={class:"text-sm"},k={__name:"StatCard",props:{stat:{type:Object,required:!0}},setup(e){const o=d;return(f,g)=>(s(),n("div",h,[t("div",_,[t("span",p,[(s(),r(i(e.stat.icon??l(o)),{size:"30",class:"text-white"}))]),t("div",m,[t("div",u,a(e.stat.value),1),t("div",v,a(e.stat.title),1)])])]))}};export{k as _};