import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { TopNavBarComponent } from './top-nav-bar/top-nav-bar.component';
import { FooterBarComponent } from './footer-bar/footer-bar.component';
import { HttpModule } from '@angular/http';

import { DataAccessService } from './data-access.service'

@NgModule({
  declarations: [
    AppComponent,
    TopNavBarComponent,
    FooterBarComponent
  ],
  imports: [
    BrowserModule, HttpModule
  ],
  providers: [ DataAccessService ],
  bootstrap: [AppComponent]
})
export class AppModule { }