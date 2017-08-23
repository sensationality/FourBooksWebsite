import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { TopNavBarComponent } from './top-nav-bar/top-nav-bar.component';
import { FooterBarComponent } from './footer-bar/footer-bar.component';
import { HttpModule } from '@angular/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { DataAccessService } from './data-access.service';
import { BookMainComponent } from './book-main/book-main.component'
import { RouterModule, Routes } from '@angular/router';
import { HomePageComponent } from './home-page/home-page.component';
import { BookViewComponent } from './book-view/book-view.component';
import { ContactComponent } from './contact/contact.component';
import { AboutComponent } from './about/about.component';

const appRoutes: Routes = [
    

  { path: 'details/:name', component: BookMainComponent },
  { path: 'view/:name/:id', component: BookViewComponent },
  { path: 'contact', component: ContactComponent },
  { path: 'about', component: AboutComponent },
  { 
        path: '', 
		component: HomePageComponent
  },
  { path: '**', redirectTo: '' }

  ]
@NgModule({
  declarations: [
    AppComponent,
    TopNavBarComponent,
    FooterBarComponent,
    BookMainComponent,
    HomePageComponent,
    BookViewComponent,
    ContactComponent,
    AboutComponent
  ],
  imports: [
	RouterModule.forRoot(
      appRoutes,
      { enableTracing: false } // <-- debugging purposes only
    ),
    BrowserModule, HttpModule,
        FormsModule,
        ReactiveFormsModule
  ],
  exports: [ RouterModule ],
  providers: [ DataAccessService ],
  bootstrap: [AppComponent]
})
export class AppModule { }
