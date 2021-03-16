# Questpass JavaScript Plugin

## Events

The Questpass plugin emits events when it changes its state. Events can be used for integration of frontend actions.

### Available events

* `questpass.ready` - triggered when the plugin is loaded and ready
* `questpass.emissionskip` - triggered when there is no adquest to display or reader has an active subscription (the page content is available without showing an adquest)
* `questpass.emissionstart` - triggered after the page content becomes blurred (before displaying adquest)
* `questpass.emissionend` - triggered after the page blur is removed and page content is unveiled (after correct answer)
* `questpass.adblockdetected` - triggered when adblock has been detected (and quest is not presented)
* `questpass.subscriptiontoggle` - triggered when user clicked on link providing to subscription view or is returning back from subscription to quest view (state in event.detail)
* `questpass.pass` - triggered when quest was not appear for some reason (reason in event.detail)

### JavaScript events handling example

```javascript
document.addEventListener('questpass.ready', function(event) {
  console.log('questpass.ready', event);
}, true);

document.addEventListener('questpass.emissionstart', function(event) {
  console.log('questpass.emissionstart', event);
}, true);

document.addEventListener('questpass.emissionend', function(event) {
  console.log('questpass.emissionend', event);
}, true);

document.addEventListener('questpass.emissionskip', function(event) {
  console.log('questpass.emissionskip', event);
}, true);

document.addEventListener('questpass.adblockdetected', function(event) {
  console.log('questpass.adblockdetected', event);
}, true);

document.addEventListener('questpass.subscriptiontoggle', function(event) {
  console.log('questpass.subscriptiontoggle', event.detail, event);
}, true);

document.addEventListener('questpass.pass', function(event) {
  console.log('questpass.pass', event.detail, event);
}, true);
```
