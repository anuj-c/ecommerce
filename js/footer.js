var foot = document.querySelector("footer");
if (foot.offsetTop < window.innerHeight)
{
  const reqHt=window.innerHeight - foot.offsetTop;
  foot.setAttribute("style", "margin-top:"+reqHt+"px");
  // console.log("done")
}