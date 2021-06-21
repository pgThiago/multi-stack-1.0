import { StatusBar } from "expo-status-bar";
import React from "react";
import Router from "ui/router/Router";
import ThemeProvider from "ui/themes/ThemeProvider";

export default function App() {
  return (
    <ThemeProvider>
      <Router />
    </ThemeProvider>
  );
}
