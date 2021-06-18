import { SafeEnvironmentContainer } from "./SafeEnvironment.style";
import { Container } from "@material-ui/core";

const SafeEnvironment: React.FC = () => {
  return (
    <SafeEnvironmentContainer>
      <Container>
        Ambiente Seguro <i className="twf-lock" />
      </Container>
    </SafeEnvironmentContainer>
  );
};

export { SafeEnvironment };
