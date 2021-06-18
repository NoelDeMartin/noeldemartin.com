import Turbolinks from 'turbolinks';
import { Application } from 'stimulus';
import { definitionsFromContext } from 'stimulus/webpack-helpers';
import { animateHeaderCollapse } from './header';

const application = Application.start();
const context = require.context('./controllers', true, /\.js$/);
application.load(definitionsFromContext(context));

Turbolinks.start();
Turbolinks.setProgressBarDelay(0);

animateHeaderCollapse();
