var stripe = Stripe(
  "pk_test_51M4dVDJ4pxonshww6jDpdczTupzhtVboHHSDp0i3e3U8LkBmB3Vg8v9O4s30h5Zg6MbShnltrZ3TlS915wElX7BF00PNfot4yG"
);

const getStripeSession = async (lineItems) => {
  const url = await stripe.redirectToCheckout({
    mode: "payment",
    lineItems,
    successUrl: window.location.href,
    cancelUrl: window.location.href,
  });

  console.log(url);

  return url;
};

const panierBtn = document.getElementById("panierBtn");

const onClick = () => {
  alert("test");
};

panierBtn.addEventListener("click", () => {
  const product = {
    price: "price_1M4dYdJ4pxonshww19ddFFm0",
    quantity: 1,
  };

  getStripeSession([product]);
});
