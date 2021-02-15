var componentArray = document.getElementsByClassName('component-item') || [];

for (var i = 0; i < componentArray.length; i++) {
  var component = componentArray.item(i);
  const newElement = document.createElement('div');

  newElement.classList.add('color-picker-' + i);
  component.appendChild(newElement);
  const pickr = Pickr.create({
    el: newElement,
    theme: 'nano', // or 'monolith', or 'nano'

    padding: 20,
    comparison: false,
    position: 'right-start',

    components: {

      // Main components
      preview: false,
      opacity: false,
      hue: true,

      // Input / output Options
      interaction: {
        hex: true,
        rgba: true,
        hsla: true,
        hsva: true,
        cmyk: true,
        input: true,
        clear: false,
        save: false
      }
    }
  });

  pickr.on('init', instance => {
    console.log('init', instance);
  }).on('hide', instance => {
    console.log('hide', instance);
  }).on('show', (color, instance) => {
    console.log('show', color, instance);
  }).on('save', (color, instance) => {
    console.log('save', color, instance);
  }).on('clear', instance => {
    console.log('clear', instance);
  }).on('change', (color, instance) => {
    console.log('change', color, instance);
  }).on('changestop', instance => {
    console.log('changestop', instance);
  }).on('cancel', instance => {
    console.log('cancel', instance);
  }).on('swatchselect', (color, instance) => {
    console.log('swatchselect', color, instance);
  });

};


