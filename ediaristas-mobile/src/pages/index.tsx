import React from "react";

import Button from "ui/components/inputs/Button";
import { RootStackParamList } from "ui/router/Router";
import { StackNavigationProp } from "@react-navigation/stack";
import { View } from "react-native";

type NavigationProp = StackNavigationProp<RootStackParamList, "Index">;

interface IndexProps {
  navigation: NavigationProp;
}

const Index: React.FC<IndexProps> = ({ navigation }) => {
  return (
    <View style={{ flex: 1, justifyContent: "center" }}>
      <Button
        mode="contained"
        onPress={() => navigation.navigate("EncontrarDiarista")}
      >
        Encontrar Diarista
      </Button>
    </View>
  );
};

export default Index;
