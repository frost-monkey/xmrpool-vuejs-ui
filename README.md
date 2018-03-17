# What's this?

This is an unfinished XMR pool web interface written in Vuejs and PHP. It was written with Clintar's fork of
[cryptonote-universal-pool](https://github.com/clintar/cryptonote-xmr-pool) as pool application/API. It could easly be
modified for other pool APIs.

## It's unfinished

I decided to close my own pool before completing this code. The miner dashboard isn't finished (stats won't refresh
after first load), graphs aren't completed at all, but one of them is working, the code contains hardcoded URLs and/or
placeholders like `[your_domain]` and `[mining_url]`.

## I'm not maintaining this

Feel free to do whatever you want with this code. Please don't file bugs: I'm not maintaining it. Fork it, and have
fun!


# To compile the Vuejs application

This makes a development build with debugable sources using the Vuejs addon for Chrome or Firefox.

```
npm install
npm run dev
```

## Build for production release

```
npm run build
```