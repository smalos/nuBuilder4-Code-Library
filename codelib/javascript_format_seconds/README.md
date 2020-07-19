## JavaScript: Format seconds

### Format seconds as minutes:seconds ([Source](https://stackoverflow.com/a/37770048/10132321))

```javascript

function formatSecondsMS(s) {
    return (s - (s %= 60)) / 60 + (9 < s ? ':' : ':0') + s
}

```
#### ✪ Example: 
formatSecondsMS('599') returns 9:59


### Format seconds as hours:minutes:seconds ([Source](https://stackoverflow.com/a/40350003/10132321))

```javascript

function formatSecondsHMS(seconds) {
  const h = Math.floor(seconds / 3600);
  const m = Math.floor((seconds % 3600) / 60);
  const s = Math.round(seconds % 60);
  return [
    h,
    m > 9 ? m : (h ? '0' + m : m || '0'),
    s > 9 ? s : '0' + s
  ].filter(Boolean).join(':');
}

```

#### ✪ Example: 
formatSecondsHMS('3699') returns 1:01:39
